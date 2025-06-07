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

class MenuController extends BaseApiController
{  
    public function listMenu()
    {   
        try {
            $menus = Menu::with('category') 
                ->get()
                ->map(function ($menu) {
                    return [
                        'id' => $menu->id,
                        'name' => $menu->name,
                        'description' => $menu->description,
                        'image' => $menu->image ? Storage::disk('public')->url($menu->image) : null,
                        'price' => $menu->price,
                        'category_id' => $menu->category_id,
                        'category' => $menu->category,  
                    ];
                });

            return $this->sendSuccessResponse(true, "Success", $menus, 200);
        } catch (\Throwable $e) {
            return $this->sendErrorResponse(false, "failed", ['exception' => $e->getMessage()], 500);
        }
    }

    public function addToCart($id)
    {
        try {  
            $menu = Menu::find($id);

            if (!$menu) {
                return $this->sendErrorResponse(400, false, "Failed", ["Menu not found"]);
            } 

            $cart = Cart::firstOrCreate([
                'customer_id' => Auth::user()->customer->id
            ]);
 
            // Tambahkan atau update quantity jika sudah ada
            $item = CartItem::where('cart_id', $cart->id)->where('menu_id', $menu->id)->first();

            if ($item) {
                $item->quantity += 1;
                $item->save();
            } else {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'menu_id' => $menu->id,
                    'quantity' => 1
                ]);
            }

            // Ambil ulang isi cart
            $cartItems = CartItem::with('menu')->where('cart_id', $cart->id)->get();
            $cartCount = $cartItems->sum('quantity');

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan ke keranjang.',
                'cart_count' => $cartCount, 
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 400);
        }
    }
}
