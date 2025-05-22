<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Order;
use App\Models\Customer;

use Hash;
use Redirect;
use Auth;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    public function index()
    {   
        return view('admin.order.index');
    } 

    public function dt(Request $request)
    {
        $query = Order::with('customer:id,name') // ambil relasi customer hanya id dan name
            ->select('orders.*');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('customer_name', function($order){
                return $order->customer->name ?? '-';
            })
            ->make(true);

            }
}
