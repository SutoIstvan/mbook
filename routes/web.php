<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserAccess;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

// Для обычных пользователей
Route::middleware(['auth', UserAccess::class . ':admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Для админов
Route::middleware(['auth', UserAccess::class . ':admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});