<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Transaction;
use App\Models\Order as OrderModel;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function callback(Request $request)
    {
        $merchantOrderId = $request->merchantOrderId;
        $order = OrderModel::where('order_code', $merchantOrderId)->first();

        if (!$order) {
            Log::info("Order not found: {$merchantOrderId}");
            return response()->json(['error' => 'Order not found'], 404);
        }

        Log::info("message", $request->all());
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
        return redirect('transaction');
    }
}