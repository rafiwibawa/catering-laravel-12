<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use App\Services\DuitkuService; 

use App\Models\Menu;
use App\Models\Category;
use App\Models\Cart;
use App\Models\CartItem; 
use App\Models\Order;
use App\Models\OrderItem;

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

    public function checkout(Request $request, DuitkuService $duitkuService)
    {         

        \Log::info('Checkout request:', $request->all());

        $user = auth()->user();
        $customer = $user->customer;
        $paymentMethod = $request->input('payment_method');

        if (!$customer) {
            return response()->json(['status' => false, 'message' => 'Data customer tidak ditemukan.'], 404);
        }

        $cart = Cart::where('customer_id', $customer->id)->first();  
        if (!$cart || $cart->cartItems->isEmpty()) {
            return response()->json(['status' => false, 'message' => 'Cart masih kosong.'], 400);
        }

        $cartItems = $cart->cartItems()->with('menu')->get();
        $totalAmount = $cartItems->sum(fn($item) => $item->quantity * $item->menu->price);
        $merchantOrderId = 'INV-' . time() . '-' . $customer->id;

        DB::beginTransaction();
        try { 
            // 1. Buat Order
            $order = Order::create([
                'order_code'    => $merchantOrderId,
                'customer_id'   => $customer->id,
                'order_date'    => now(),
                'delivery_date' => null,  
                'status'        => 'pending',
            ]);

            // 2. Simpan OrderItem
            $orderItems = $cartItems->map(function ($item) use ($order) {
                return [
                    'order_id'   => $order->id,
                    'menu_id'    => $item->menu_id,
                    'quantity'   => $item->quantity,
                    'subtotal'   => $item->quantity * $item->menu->price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            })->toArray();
            OrderItem::insert($orderItems);
 
            // 3. Buat order ke Duitku
            $orderPayload = [
                "merchantOrderId"  => $merchantOrderId,
                "paymentAmount"    => $totalAmount,
                "productDetails"   => "Checkout Cart",
                "paymentMethod"    => $paymentMethod,
                "email"            => $user->email,
                "phoneNumber"      => $customer->phone ?? "08123456789",
                "customerVaName"   => $customer->name,
                "callbackUrl"      => route('duitku.callback'),
                "returnUrl"        => route('duitku.return'),
                "expiryPeriod"     => 60,
            ];

            $response = $duitkuService->createPayment($orderPayload);

            if (isset($response['statusCode']) && $response['statusCode'] == "00") {
                DB::commit();

                // kosongkan cart setelah sukses
                $cart->cartItems()->delete();

                return response()->json([
                    'status' => true,
                    'message' => 'Checkout berhasil',
                    'data' => [
                        'order_code' => $merchantOrderId,
                        'total' => $totalAmount,
                        'payment_url' => $response['paymentUrl'],
                        'reference' => $response['reference'] ?? null,
                        'payment_method' => $paymentMethod,
                    ]
                ], 200);
            }

            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $response['statusMessage'] ?? 'Gagal membuat pembayaran',
            ], 400);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function removeItem($id)
    {
        try {
            $item = CartItem::findOrFail($id);
            $item->delete();
            return response()->json([
                'status' => true,
                'message' => 'Item berhasil dihapus',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Item gagal dihapus',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function plusItem($id)
    {
        try {
            $item = CartItem::findOrFail($id);
            $item->quantity++;
            $item->save();
            return response()->json([
                'status' => true,
                'message' => 'Item berhasil diupdate',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Item gagal diupdate',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function minusItem($id){
        try {
            $item = CartItem::findOrFail($id);
            if ($item->quantity > 1) {
                $item->quantity--;
                $item->save();
            } else {
                $item->delete();
            }
            return response()->json([
                'status' => true,
                'message' => 'Item berhasil diupdate',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Item gagal diupdate',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
