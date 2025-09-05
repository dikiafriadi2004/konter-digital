<?php

namespace App\Providers;

use App\Models\Cms\Menu;
use App\Models\Cms\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            // Ambil semua menu utama (beserta child)
            $menus = Menu::whereNull('parent_id')
                ->orderBy('order')
                ->with('children')
                ->get();

            // Ambil pengaturan site
            $setting = Setting::first();

            // Share ke semua view
            $view->with([
                'menus'   => $menus,
                'setting' => $setting,
            ]);
        });
    }
}
