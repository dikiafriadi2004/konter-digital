<?php

namespace App\Providers;

use App\Models\Cms\Menu;
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
            $menus = Menu::whereNull('parent_id')
                ->orderBy('order')
                ->with('children')
                ->get();

            $view->with('menus', $menus);
        });
    }
}
