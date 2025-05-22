<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cart;
use App\Models\CartItem;

use Auth;

class CartController extends Controller
{
    public function index()
    {  
        $customerId = Auth::user()->customer->id;

        $cart = Cart::where('customer_id', $customerId)
                    ->latest()
                    ->with(['cartItems.menu']) // eager load
                    ->first(); // ambil cart terbaru

        return view('customer.cart.index', compact('cart'));
    }
}
