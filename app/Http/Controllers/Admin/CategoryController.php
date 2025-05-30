<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
use App\Models\Category;

use Hash;
use Redirect;
use Auth;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function index()
    {   
        return view('admin.category.index');
    } 
    
    public function dt(Request $request)
    { 
        $query = Category::orderBy('id', 'desc')->get();

        return DataTables::of($query)
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name',
            ]);

            $category = Category::create([
                'name' => $validated['name'],
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Category berhasil ditambahkan',
                'data' => $category,
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
                'name' => 'required|string|max:255|unique:categories,name,' . $id,
            ]);

            $category = Category::where('id', $id)->update([
                'name' => $validated['name'],
            ]); 

            return response()->json([
                'status' => 200,
                'message' => 'Category berhasil diperbarui',
                'data' => $category,
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
            Category::findOrFail($id)->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Category berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan saat menghapus data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
    public function list()
    {
        return response()->json(Category::select('id', 'name')->get());
    }
}
