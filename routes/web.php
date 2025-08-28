<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cms\MenuController;
use App\Http\Controllers\Cms\PageController;
use App\Http\Controllers\Cms\PostController;
use App\Http\Controllers\Cms\RoleController;
use App\Http\Controllers\Cms\UserController;
use App\Http\Controllers\Cms\ProfileController;
use App\Http\Controllers\Cms\SettingController;
use App\Http\Controllers\Cms\CategoryController;
use App\Http\Controllers\Cms\DashboardController;

Route::get('/', function () {
    return view('front.home.index');
});

Route::middleware('auth')->group(function () {

    Route::prefix('cms')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('cms.dashboard.index');

        // Profile routes
        Route::get('/profile', [ProfileController::class, 'edit'])->name('cms.profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('cms.profile.update');

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

        // Menu
        Route::get('menus', [MenuController::class, 'index'])->name('menus.index');
        Route::post('menus', [MenuController::class, 'store'])->name('menus.store');
        Route::put('menus/{menu}', [MenuController::class, 'update'])->name('menus.update');
        Route::delete('menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');

        // update order
        Route::post('menus/update-order', [MenuController::class, 'updateOrder'])->name('menus.updateOrder');

        Route::resource('/roles', RoleController::class);

        // Settings
        Route::get('settings', [SettingController::class, 'edit'])->name('cms.settings.edit');
        Route::post('settings', [SettingController::class, 'update'])->name('cms.settings.update');

        // Users
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});

require __DIR__ . '/auth.php';
