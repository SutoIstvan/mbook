<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemorialController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserAccess;

Auth::routes();

Route::get('/', function () {
    return redirect('/dashboard');
});


// Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

// Для обычных пользователей
Route::middleware(['auth', UserAccess::class . ':user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/create', [MemorialController::class, 'create'])->name('memorial.create');
    Route::post('/store', [MemorialController::class, 'store'])->name('memorial.store');
    Route::get('/dashboard/{memorial}/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::put('/dashboard/memorial/{id}', [MemorialController::class, 'update'])->name('memorial.update');
    Route::delete('/photo/delete/{id}', [MemorialController::class, 'deletePhoto'])->name('photo.delete');

    Route::get('/dashboard/{memorial}/settings', [DashboardController::class, 'settings'])->name('dashboard.settings');
    Route::post('/dashboard/{memorial}/settings', [DashboardController::class, 'updateSettings'])->name('dashboard.settings.update');

    Route::get('/dashboard/{memorial}/comments', [DashboardController::class, 'comments'])->name('dashboard.comments');
    Route::patch('/comments/{comment}/approve', [CommentController::class, 'approve'])->name('comments.approve');
    Route::patch('/comments/{comment}/reject', [CommentController::class, 'reject'])->name('comments.reject');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    Route::get('/dashboard/{memorial}/video', [DashboardController::class, 'video'])->name('dashboard.video');
    Route::post('/dashboard/{memorial}/video', [DashboardController::class, 'VideoBackground'])->name('dashboard.video.upload');

    Route::get('/dashboard/{memorial}/photos', [DashboardController::class, 'photos'])->name('dashboard.photos');
    Route::post('/dashboard/{memorial}/photos', [ImageController::class, 'uploadImages'])->name('memorial.images.upload');
    Route::post('/dashboard/{memorial}/photos/update', [ImageController::class, 'updateImages'])->name('memorial.images.update');
    Route::delete('/dashboard/{memorial}/photos/{image}', [ImageController::class, 'destroy'])->name('memorial.images.destroy');
    Route::delete('/dashboard/{memorial}/photos', [ImageController::class, 'destroyAllImages'])->name('memorials.images.destroyAll');

    Route::get('/dashboard/{memorial}/help', [DashboardController::class, 'help'])->name('dashboard.help');
    
    Route::delete('/dashboard/delete/{memorial}', [DashboardController::class, 'destroy'])->name('dashboard.destroy')->middleware('auth');

});

// Для админов
Route::middleware(['auth', UserAccess::class . ':admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::get('/admin/memorials', [AdminController::class, 'memorials'])->name('admin.memorials');
    Route::get('/admin/codeattach', [AdminController::class, 'codeattach'])->name('admin.codeattach');
    Route::get('/admin/codegenerate', [AdminController::class, 'codegenerate'])->name('admin.codegenerate');

    Route::post('/generate-qrcodes', [AdminController::class, 'generateUniqueToken'])->name('generate.qrcodes');
    Route::post('/codelink', [AdminController::class, 'codelink'])->name('admin.codelink');

    Route::get('/storage/qrcodes/{filename}', function ($filename) {
        $filePath = storage_path('app/storage/qrcodes/' . $filename);
        if (file_exists($filePath)) {
            return response()->download($filePath);
        }
        return redirect()->back()->with('error', 'File not found');
    })->name('download.qrcodes');

});

Route::get('/memorial/attach/{token}', [MemorialController::class, 'showAttachForm'])->name('memorial.attach.form')->middleware('auth');

Route::get('/{memorial}', [MemorialController::class, 'show'])->name('memorial.show');
Route::get('/{memorial}/biography', [MemorialController::class, 'biography'])->name('memorial.biography');
Route::get('/{memorial}/photos', [MemorialController::class, 'photos'])->name('memorial.photos');
Route::get('/{memorial}/videos', [MemorialController::class, 'videos'])->name('memorial.videos');
Route::get('/{memorial}/comments', [MemorialController::class, 'comments'])->name('memorial.comments');

Route::get('/{memorial}/comments/create', [CommentController::class, 'create'])->name('comments.create');
Route::post('/{memorial}/comments', [CommentController::class, 'store'])->name('comments.store');
