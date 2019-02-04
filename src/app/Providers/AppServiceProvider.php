<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Database String Length Fix
        Schema::defaultStringLength(191);

        // Load Helpers
        include(app_path().'/Helpers/themeHelper.php');
        include(app_path().'/Helpers/platformHelper.php');
        include(app_path().'/Helpers/appHelper.php');
        include(app_path().'/Helpers/guestHelper.php');


        // Variables Per Element
        view()->composer('layouts.admin.sidebar', function ($view) {
            $menu = menu_admin_sidebar();
            $view->with('menu', $menu);
        });

        view()->composer('layouts.app.header', function ($view) {
            $menu = menu_app_main();
            $view->with('menu', $menu);
        });

        view()->composer('layouts.guest.header', function ($view) {
            $menu = menu_guest_main();
            $view->with('menu', $menu);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
