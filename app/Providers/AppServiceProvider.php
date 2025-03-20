<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        //
        View::composer('*', function ($view) {
            $cart = session('cart', []);
            $cart_count = 0;
            
            if (!empty($cart)) {
                $cart_count = array_sum(array_column($cart, 'quantity'));
            }
            
            $view->with('cart_count', $cart_count);
        });
    }
}