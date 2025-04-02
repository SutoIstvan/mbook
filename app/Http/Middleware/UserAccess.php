<?php

namespace App\Http\Middleware;

use App\Models\Memorial;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccess
{
    public function handle(Request $request, Closure $next)
{
    $user = Auth::user();
    
    // Если пользователь админ, разрешаем доступ
    if ($user && $user->role === 'admin') {
        return $next($request);
    }
    
    // Если параметр memorial не передан, пропускаем (например, для /dashboard)
    $memorial = $request->route('memorial');
    if (!$memorial) {
        return $next($request); // Пропускаем, если мемориал не указан
    }
    
    // Если мемориал передан как строка или ID, находим его
    if (!$memorial instanceof Memorial) {
        if (is_numeric($memorial)) {
            $memorial = Memorial::find($memorial);
        } else {
            // Добавляем поддержку slug
            $memorial = Memorial::where('slug', $memorial)->first();
        }
    }
    
    // Проверяем, существует ли мемориал
    if (!$memorial) {
        abort(404, 'Мемориал не найден.');
    }
    
    // Проверяем права доступа
    if (!$user || $memorial->admin_id != $user->id) {
        abort(403, 'У вас нет прав для выполнения этого действия.');
    }
    
    return $next($request);
}
    // public function handle(Request $request, Closure $next)
    // {
    //     $user = Auth::user();
        
    //     // Если пользователь админ, разрешаем доступ
    //     if ($user && $user->role === 'admin') {
    //         return $next($request);
    //     }
        
    //     // Если параметр memorial не передан, пропускаем (например, для /dashboard)
    //     $memorial = $request->route('memorial');
    //     if (!$memorial) {
    //         return $next($request); // Пропускаем, если мемориал не указан
    //     }
        
    //     // Если мемориал передан как ID, находим его
    //     if (!$memorial instanceof Memorial && is_numeric($memorial)) {
    //         $memorial = Memorial::find($memorial);
    //     }
        
    //     // Проверяем, существует ли мемориал
    //     if (!$memorial) {
    //         abort(404, 'Мемориал не найден.');
    //     }
        
    //     // Проверяем права доступа
    //     if (!$user || $memorial->admin_id != $user->id) {
    //         abort(403, 'У вас нет прав для выполнения этого действия.');
    //     }
        
    //     return $next($request);
    // }
}