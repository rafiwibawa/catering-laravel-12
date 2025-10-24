<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

use App\Models\Menu;
use App\Models\Category;
use App\Models\Cart;
use App\Models\CartItem;

use Auth;

class CartController extends BaseApiController
{  
    public function listCart()
    {   
        try {
            $cart = Cart::where('customer_id', Auth::user()->customer->id)
                    ->latest()
                    ->with(['cartItems.menu']) 
                    ->first();

            if ($cart) {
                $cart->cartItems->transform(function ($item) {
                    $menu = $item->menu;
                    $item->menu->image = $menu->image
                        ? Storage::disk('public')->url($menu->image)
                        : null;
                    return $item;
                });
            }
            return $this->sendSuccessResponse(true, "Success", $cart, 200);
        } catch (\Throwable $e) {
            return $this->sendErrorResponse(false, "failed", ['exception' => $e->getMessage()], 500);
        }
    } 

    public function cartCount()
    {
        try {
            $count = CartItem::whereHas('cart', function ($q) {
                $q->where('customer_id', Auth::user()->customer->id);
            })->count();
            
            return $this->sendSuccessResponse(true, "Success", ['count' => $count], 200);
        } catch (\Throwable $e) {
            return $this->sendErrorResponse(false, "failed", ['exception' => $e->getMessage()], 500);
        }
    }
}
