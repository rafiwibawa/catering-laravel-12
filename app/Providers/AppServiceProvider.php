<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\CartItem;

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
            if (!request()->is('about', 'profile', 'cart', '/', 'home', 'menu', 'menu/search', 'menu/add-to-cart/*', 'transaction')) {
                return;
            }
    
            $cartItems = collect();
    
            if (Auth::check() && Auth::user()->role == 'customer') {
                $cart = Cart::where('customer_id', Auth::user()->customer->id)->latest()->first();
    
                if ($cart) {
                    $cartItems = CartItem::with('menu')
                        ->where('cart_id', $cart->id)
                        ->get();
                }
            }
    
            $view->with('cartItems', $cartItems);
            $view->with('cartCount', $cartItems->sum('quantity'));
        });    
    }
}
