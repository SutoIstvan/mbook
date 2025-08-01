<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Добавляем ваш middleware в web группу
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
        ]);
        
        // Или если нужно в API тоже:
        // $middleware->api(append: [
        //     \App\Http\Middleware\SetLocale::class,
        // ]);
        
        // Или глобально для всех запросов:
        // $middleware->append(\App\Http\Middleware\SetLocale::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
