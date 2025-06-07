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

            return $this->sendSuccessResponse(true, "Success", $cart, 200);
        } catch (\Throwable $e) {
            return $this->sendErrorResponse(false, "failed", ['exception' => $e->getMessage()], 500);
        }
    } 
}
