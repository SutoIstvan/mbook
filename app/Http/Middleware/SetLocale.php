<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // Проверяем сессию на сохраненный язык
        if (Session::has('locale')) {
            $locale = Session::get('locale');
        } else {
            // Получаем языки браузера
            $browserLocales = $this->getBrowserLocales($request);
            
            // Поддерживаемые языки вашего приложения
            $supportedLocales = ['en', 'hu', 'sk', 'ru']; // Добавьте ваши языки
            
            // Находим подходящий язык
            $locale = $this->findBestLocale($browserLocales, $supportedLocales);
            
            // Сохраняем в сессию
            Session::put('locale', $locale);
        }
        
        // Устанавливаем локаль
        App::setLocale($locale);
        
        // App::setLocale('sk');
        
        return $next($request);
    }
    
    /**
     * Получить языки браузера из заголовка Accept-Language
     */
    private function getBrowserLocales(Request $request): array
    {
        $acceptLanguage = $request->header('Accept-Language');
        
        if (!$acceptLanguage) {
            return ['en']; // Fallback
        }
        
        $locales = [];
        
        // Парсим заголовок Accept-Language
        // Пример: "hu-HU,hu;q=0.9,en;q=0.8,ru;q=0.7"
        preg_match_all('/([a-z]{2}(?:-[A-Z]{2})?)\s*(?:;\s*q\s*=\s*([0-9\.]+))?/i', 
                      $acceptLanguage, $matches, PREG_SET_ORDER);
        
        foreach ($matches as $match) {
            $locale = strtolower(substr($match[1], 0, 2)); // Берем только код языка
            $quality = isset($match[2]) ? (float) $match[2] : 1.0;
            $locales[$locale] = $quality;
        }
        
        // Сортируем по приоритету
        arsort($locales);
        
        return array_keys($locales);
    }
    
    /**
     * Найти лучший подходящий язык
     */
    private function findBestLocale(array $browserLocales, array $supportedLocales): string
    {
        foreach ($browserLocales as $browserLocale) {
            if (in_array($browserLocale, $supportedLocales)) {
                return $browserLocale;
            }
        }
        
        // Fallback на первый поддерживаемый язык
        return $supportedLocales[0] ?? 'en';
    }
}