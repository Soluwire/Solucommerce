<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Resources\Json\Resource;
use App\{MenuItem,Category};
use SoluHelpers\Config\Config;
use SoluHelpers\Cart\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(\App::runningInConsole())
        {
        // app is running in console
        }else{
            Cart::CreateCart();
            Resource::withoutWrapping();
            Schema::defaultStringLength(191);
            $menu = MenuItem::all();
            $categories = Category::all();
            View::share(array_merge([
                'currency' => Config::$currency, 
                'categories' => $categories,
                'menuitems' => $menu
            ]));
}

    }
}
