<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cms\MenuController;
use App\Http\Controllers\Cms\PageController;
use App\Http\Controllers\Cms\PostController;
use App\Http\Controllers\Cms\RoleController;
use App\Http\Controllers\Cms\UserController;
use App\Http\Controllers\Front\BlogController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Cms\LandingController;
use App\Http\Controllers\Cms\ProfileController;
use App\Http\Controllers\Cms\SettingController;
use App\Http\Controllers\Cms\CategoryController;
use App\Http\Controllers\Cms\DashboardController;
use App\Http\Controllers\Cms\FileManagerController;
use App\Http\Controllers\Front\AboutUsController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\PagesController;

Route::get('/', [HomeController::class, 'index'])->name('front.home.index');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::get('/about', [AboutUsController::class, 'index'])->name('about.index');


Route::middleware('auth')->prefix('cms')->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('cms.dashboard.index');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('cms.profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('cms.profile.update');

    // Categories
    Route::middleware('permission:Category Show')->group(function () {
        Route::resource('categories', CategoryController::class);
    });

    // Posts
    Route::middleware([
        'permission:Posts Show|Posts Create|Posts Edit|Posts Delete'
    ])->group(function () {
        Route::get('posts', [PostController::class, 'index'])->name('cms.posts.index');
        Route::get('posts/create', [PostController::class, 'create'])->name('cms.posts.create')->middleware('permission:Posts Create');
        Route::post('posts', [PostController::class, 'store'])->name('cms.posts.store')->middleware('permission:Posts Create');
        Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('cms.posts.edit')->middleware('permission:Posts Edit');
        Route::put('posts/{post}', [PostController::class, 'update'])->name('cms.posts.update')->middleware('permission:Posts Edit');
        Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('cms.posts.destroy')->middleware('permission:Posts Delete');

        Route::get('posts/trash', [PostController::class, 'trash'])->name('cms.posts.trash');
        Route::post('posts/{id}/restore', [PostController::class, 'restore'])->name('cms.posts.restore');
        Route::delete('posts/{id}/force-delete', [PostController::class, 'forceDelete'])->name('cms.posts.force-delete');
    });

    // Pages
    Route::middleware([
        'permission:Pages Show|Pages Create|Pages Edit|Pages Delete'
    ])->group(function () {
        Route::get('pages', [PageController::class, 'index'])->name('cms.pages.index');
        Route::get('pages/create', [PageController::class, 'create'])->name('cms.pages.create')->middleware('permission:Pages Create');
        Route::post('pages', [PageController::class, 'store'])->name('cms.pages.store')->middleware('permission:Pages Create');
        Route::get('pages/{page}/edit', [PageController::class, 'edit'])->name('cms.pages.edit')->middleware('permission:Pages Edit');
        Route::put('pages/{page}', [PageController::class, 'update'])->name('cms.pages.update')->middleware('permission:Pages Edit');
        Route::delete('pages/{page}', [PageController::class, 'destroy'])->name('cms.pages.destroy')->middleware('permission:Pages Delete');

        Route::get('pages/trash', [PageController::class, 'trash'])->name('cms.pages.trash');
        Route::post('pages/{id}/restore', [PageController::class, 'restore'])->name('cms.pages.restore');
        Route::delete('pages/{id}/force-delete', [PageController::class, 'forceDelete'])->name('cms.pages.force-delete');
    });

    // Menus
    Route::middleware([
        'permission:Menu Create|Menu Delete'
    ])->group(function () {
        Route::resource('menus', MenuController::class);
        Route::post('menus/reorder', [MenuController::class, 'reorder'])->name('menus.reorder');
    });

    // Roles
    Route::middleware([
        'permission:Role Show|Role Create|Role Edit|Role Delete'
    ])->group(function () {
        Route::resource('/roles', RoleController::class);
    });

    // Settings
    Route::middleware('permission:Settings Show')->group(function () {
        Route::get('settings', [SettingController::class, 'edit'])->name('cms.settings.edit');
        Route::post('settings', [SettingController::class, 'update'])->name('cms.settings.update');
    });

    // Landing
    Route::middleware('permission:Landing Show')->group(function () {
        Route::get('landing', [LandingController::class, 'edit'])->name('cms.landing.edit');
        Route::post('landing', [LandingController::class, 'update'])->name('cms.landing.update');
    });

    // Users
    Route::middleware([
        'permission:User Show|User Create|User Edit|User Delete'
    ])->group(function () {
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/create', [UserController::class, 'create'])->name('users.create')->middleware('permission:User Create');
        Route::post('users', [UserController::class, 'store'])->name('users.store')->middleware('permission:User Create');

        // ---- TRASH / RESTORE / FORCE DELETE ----
        Route::get('users/trash', [UserController::class, 'trash'])->name('users.trash');
        Route::post('users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
        Route::delete('users/{id}/force-delete', [UserController::class, 'forceDelete'])->name('users.forceDelete');
        // ---------------------------------------

        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('permission:User Edit');
        Route::put('users/{user}', [UserController::class, 'update'])->name('users.update')->middleware('permission:User Edit');
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('permission:User Delete');
    });

    // Filemanager
    Route::prefix('filemanager')->name('cms.filemanager.')->group(function () {
        Route::get('/', [FileManagerController::class, 'index'])->name('index');
        Route::post('/upload', [FileManagerController::class, 'upload'])->name('upload');
        Route::delete('/delete', [FileManagerController::class, 'delete'])->name('delete');
    });
});

require __DIR__ . '/auth.php';

Route::get('/{slug}', [PagesController::class, 'show'])->name('front.pages.show');
