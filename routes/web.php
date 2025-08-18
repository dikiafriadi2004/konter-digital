<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Cms\PageController;
use App\Http\Controllers\Cms\PostController;
use App\Http\Controllers\Cms\CategoryController;
use App\Http\Controllers\Cms\DashboardController;

Route::get('/', function () {
    return view('front.home.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('cms')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('cms.dashboard.index');

        // Resource routes for categories
        Route::resource('categories', CategoryController::class);

        // Post Routes
        Route::get('posts', [PostController::class, 'index'])->name('cms.posts.index'); // List semua post
        Route::get('posts/create', [PostController::class, 'create'])->name('cms.posts.create'); // Form tambah post
        Route::post('posts', [PostController::class, 'store'])->name('cms.posts.store'); // Simpan post baru
        Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('cms.posts.edit'); // Form edit
        Route::put('posts/{post}', [PostController::class, 'update'])->name('cms.posts.update'); // Update post
        Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('cms.posts.destroy'); // Soft delete


        // Tambahan untuk trash
        Route::get('posts/trash', [PostController::class, 'trash'])->name('cms.posts.trash');

        Route::post('posts/{id}/restore', [PostController::class, 'restore'])->name('cms.posts.restore');
        Route::delete('posts/{id}/force-delete', [PostController::class, 'forceDelete'])->name('cms.posts.force-delete');

        // Page Routes
        Route::get('pages', [PageController::class, 'index'])->name('cms.pages.index');
        Route::get('pages/create', [PageController::class, 'create'])->name('cms.pages.create');
        Route::post('pages', [PageController::class, 'store'])->name('cms.pages.store');
        Route::get('pages/{page}/edit', [PageController::class, 'edit'])->name('cms.pages.edit');
        Route::put('pages/{page}', [PageController::class, 'update'])->name('cms.pages.update');
        Route::delete('pages/{page}', [PageController::class, 'destroy'])->name('cms.pages.destroy');

        // Trash
        Route::get('pages/trash', [PageController::class, 'trash'])->name('cms.pages.trash');
        Route::post('pages/{id}/restore', [PageController::class, 'restore'])->name('cms.pages.restore');
        Route::delete('pages/{id}/force-delete', [PageController::class, 'forceDelete'])->name('cms.pages.force-delete');
    });
});

require __DIR__ . '/auth.php';
