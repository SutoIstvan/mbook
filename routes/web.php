<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemorialController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserAccess;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

// Для обычных пользователей
Route::middleware(['auth', UserAccess::class . ':user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/{memorial}/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::get('/dashboard/{memorial}/settings', [DashboardController::class, 'settings'])->name('dashboard.settings');
    Route::get('/dashboard/{memorial}/comments', [DashboardController::class, 'comments'])->name('dashboard.comments');
    Route::get('/dashboard/{memorial}/video', [DashboardController::class, 'video'])->name('dashboard.video');
    Route::get('/dashboard/{memorial}/photos', [DashboardController::class, 'photos'])->name('dashboard.photos');
    Route::get('/dashboard/help', [DashboardController::class, 'help'])->name('dashboard.help');


    Route::get('/create', [MemorialController::class, 'create'])->name('memorials.create');
    Route::post('/store', [MemorialController::class, 'store'])->name('memorial.store');
});

// Для админов
Route::middleware(['auth', UserAccess::class . ':admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');

});


Route::get('/memorial/{memorial}', [MemorialController::class, 'show'])->name('memorials.show');

