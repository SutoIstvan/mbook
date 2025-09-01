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
        // === 1. Проверяем, есть ли язык в сессии ===
        if (Session::has('locale')) {
            $locale = Session::get('locale');
        } else {
            // === 2. Получаем языки браузера ===
            $browserLocales = $this->getBrowserLocales($request);

            // === 3. Поддерживаемые языки приложения ===
            $supportedLocales = ['en', 'hu', 'sk', 'ru', 'fi'];

            // === 4. Находим лучший язык ===
            $locale = $this->findBestLocale($browserLocales, $supportedLocales);

            // === 5. Сохраняем локаль в сессии ===
            Session::put('locale', $locale);
        }

        // === 6. Устанавливаем язык ===
        App::setLocale($locale);

        // === 7. Для теста: раскомментируй строку ниже, чтобы всегда был финский ===
        App::setLocale('en');

        return $next($request);
    }

    /**
     * Получить языки браузера из заголовка Accept-Language
     */
    private function getBrowserLocales(Request $request): array
    {
        $acceptLanguage = $request->header('Accept-Language');

        if (!$acceptLanguage) {
            // Если заголовка нет — fallback из конфига
            return [config('app.fallback_locale', 'en')];
        }

        $locales = [];

        // Пример Accept-Language: "fi-FI,fi;q=0.9,hu;q=0.8,en;q=0.7"
        preg_match_all(
            '/([a-z]{2})(?:-[A-Z]{2})?\s*(?:;\s*q\s*=\s*([0-9\.]+))?/i',
            $acceptLanguage,
            $matches,
            PREG_SET_ORDER
        );

        foreach ($matches as $match) {
            $locale = strtolower($match[1]); // Берём только 2 буквы
            $quality = isset($match[2]) ? (float) $match[2] : 1.0;
            $locales[$locale] = $quality;
        }

        // Сортируем языки по приоритету (q=)
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

        // Если ничего не совпало — берём fallback
        return config('app.fallback_locale', $supportedLocales[0] ?? 'en');
    }
}
