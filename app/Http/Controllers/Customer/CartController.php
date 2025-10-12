<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\DuitkuService; 
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;

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

    public function checkout(Request $request, DuitkuService $duitkuService)
    {
        $customer = auth()->user()->customer;
 
        $paymentMethod = $request->query('payment_method');

        if (!$customer) {
            return redirect()->back()->with('error', 'Data customer tidak ditemukan.');
        }

        $cart = Cart::where('customer_id', $customer->id)->first();  
        
        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Cart masih kosong.');
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

            // 2. Simpan OrderItem (bulk insert biar efisien)
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
 
            // 3. Buat order untuk Duitku
            $orderPayload = [
                "merchantOrderId"  => $merchantOrderId,
                "paymentAmount"    => $totalAmount,
                "productDetails"   => "Checkout Cart",
                "paymentMethod"    => $paymentMethod,
                "email"            => auth()->user()->email,
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

                return redirect()->away($response['paymentUrl']);
            }

            DB::rollBack();
            return redirect()->back()->with('error', $response['statusMessage'] ?? 'Gagal membuat pembayaran');

        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
