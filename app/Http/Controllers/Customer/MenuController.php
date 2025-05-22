<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

use App\Models\Menu;
use App\Models\Category;
use App\Models\Cart;
use App\Models\CartItem;

use Auth;

class MenuController extends BaseController
{
    public function index()
    {  
        $data = [
            'menu' => Menu::all(),
            'category' => Category::all()
        ];
 
        return view('customer.menu.index', compact('data'));
    }  

    public function addToCart($id)
    {
        try {
            if (!Auth::check()) { // Memeriksa apakah pengguna sudah login
                return $this->sendErrorResponse(400, false, "Failed", ["Please login first"]);
            }

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

            // Render partial HTML dropdown
            $dropdownHtml = view('customer.partials.cart_dropdown', compact('cartItems'))->render();

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan ke keranjang.',
                'cart_count' => $cartCount,
                'dropdown_html' => $dropdownHtml,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 400);
        }
    }

    public function search(Request $request)
    {
        $budget = (int) $request->budget;
        $quantity = (int) $request->quantity;
    
        if ($budget <= 0 || $quantity <= 0) {
            return redirect()->back()->with('error', 'Budget dan jumlah harus lebih dari 0');
        }
    
        $maxPricePerItem = floor($budget / $quantity);
    
        // Filter menu yang harganya tidak melebihi max per item
        $menu = Menu::where('price', '<=', $maxPricePerItem)->get();
        $category = Category::all();
    
        return view('customer.menu.index', [
            'data' => [
                'menu' => $menu,
                'category' => $category,
            ]
        ]);
    }
}
