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

class TransactionController extends Controller
{
    public function index()
    {    
        return view('customer.transaction.index');
    } 

    public function data(Request $request)
    {
        $customerId = Auth::user()->customer->id;

        $query = Order::where('customer_id', $customerId)->with(['customer', 'items.menu', 'payment'])
            ->orderByDesc('id');

        // === Filter tanggal & status ===
        if ($request->filled('start_date')) {
            $query->whereDate('order_date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('order_date', '<=', $request->end_date);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(10);
 
        // === Format response ===
        $transactions = $orders->getCollection()->map(function ($order) {
            return [
                'id' => $order->order_code,
                'date' => $order->created_at,
                'description' => $order->items->pluck('menu.name')->join(', '),
                'amount' => $order->items->sum('subtotal'),
                'status' => $order->status,
                'notes' => $order->payment->notes ?? null,
            ];
        });

        // Hitung statistik total
        $allOrders = Order::with('items')
            ->when($request->filled('status'), fn($q) => $q->where('status', $request->status))
            ->get();

        $stats = [
            'total' => $allOrders->count(),
            'success' => $allOrders->where('status', 'success')->count(),
            'amount' => $allOrders->flatMap->items->sum('subtotal'),
        ];

        // Format pagination
        $pagination = [
            'current_page' => $orders->currentPage(),
            'total_pages' => $orders->lastPage(),
            'showing' => $orders->count(),
            'total' => $orders->total(),
        ];

        // Return JSON ke frontend
        return response()->json([
            'data' => $transactions,
            'pagination' => $pagination,
            'stats' => $stats,
        ]);
    }

    public function invoice($order_code)
    {
        $order = Order::where('order_code', $order_code)->with('customer', 'items.menu')->first();
        
        return view('customer.print.invoice', compact('order'));
    }
}
