<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
use App\Models\Customer;

use Hash;
use Redirect;
use Auth;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    public function index()
    {   
        return view('admin.customer.index');
    } 
    
    public function dt(Request $request)
    { 
        $query = Customer::orderBy('id', 'desc')->get();

        return DataTables::of($query)
            ->addIndexColumn()
            ->make(true);
    } 

    public function destroy($id)
    {
        try {
            $customer = Customer::findOrFail($id); 
            $customer->user()->delete(); 
            $customer->delete();
            
            return response()->json([
                'status' => 200,
                'message' => 'Customer berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan saat menghapus data',
                'error' => $e->getMessage(),
            ], 500);
        }
    } 
}
