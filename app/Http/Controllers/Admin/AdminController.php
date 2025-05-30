<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
use App\Models\User;

use Hash;
use Redirect;
use Auth;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function index()
    {   
        return view('admin.admin.index');
    } 
    
    public function dt(Request $request)
    { 
        $query = User::orderBy('id', 'desc')->get();

        return DataTables::of($query)
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|string|email|unique:users,email',
                'password' => 'required|string|min:6', 
            ]);

            $admin = User::create([ 
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'admin',
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'admin berhasil ditambahkan',
                'data' => $admin,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 422,
                'message' => 'Validasi gagal',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan saat menyimpan data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|string|email|unique:users,email,' . $id,
                'password' => 'nullable|string|min:6|confirmed',
            ]);

            $updateData = [
                'email' => $validated['email'],
            ];
            
            if (!empty($validated['password'])) {
                $updateData['password'] = Hash::make($validated['password']);
            }
            
            User::where('id', $id)->update($updateData);

            return response()->json([
                'status' => 200,
                'message' => 'Data admin berhasil diperbarui',
                'data' => $admin,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 422,
                'message' => 'Validasi gagal',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan saat memperbarui data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            User::findOrFail($id)->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Admin berhasil dihapus',
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
