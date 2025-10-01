<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Transaction;

class PaymentController extends Controller
{
    public function callback(Request $request)
    {
        $merchantOrderId = $request->merchantOrderId;
        $order = Order::where('id', $merchantOrderId)->first();

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        if ($request->resultCode == "00") {
            // sukses
            $order->update(['status' => 'paid']);

            Payment::create([
                'order_id'     => $order->id,
                'payment_date' => now(),
                'amount'       => $request->amount,
                'method'       => $request->paymentMethod,
                'status'       => 'success',
            ]);
        } else {
            // gagal / expired
            $order->update(['status' => 'failed']);

            Payment::create([
                'order_id'     => $order->id,
                'payment_date' => now(),
                'amount'       => $request->amount,
                'method'       => $request->paymentMethod,
                'status'       => 'failed',
            ]);
        }

        return response()->json(['message' => 'OK']);
    }

    public function return(Request $request)
    {
        return view('payment.return', ['data' => $request->all()]);
    }
}