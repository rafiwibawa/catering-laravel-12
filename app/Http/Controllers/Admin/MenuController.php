<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Menu;
use App\Models\Customer;

use Hash;
use Redirect;
use Auth;
use DB;
use Yajra\DataTables\DataTables;

class MenuController extends Controller
{
    public function index()
    {   
        return view('admin.menu.index');
    } 

    public function dt(Request $request)
    { 
        $query = Menu::with(['creator:id,email', 'category:id,name']) 
            ->orderBy('id', 'desc') 
            ->select('menus.*');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('created_by_name', function($menu){
                return $menu->creator->email ?? '-';
            })
            ->addColumn('category_name', function($menu){
                return $menu->category->name ?? '-';
            })
            ->make(true);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'nullable|integer',
            'image' => 'nullable|image|max:2048',
            'is_home' => 'nullable|boolean',
            'diskon' => 'nullable|integer',
        ]);

        try {
            DB::beginTransaction();

            $data = [
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'price' => $validated['price'],
                'category_id' => $validated['category_id'] ?? null,
                'created_by' => Auth::id(),
                'diskon' => $validated['diskon'] ?? null,
                'is_home' => $validated['is_home'] ?? 0 
            ];

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('menus', 'public');
            }

            Menu::create($data);

            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => 'Menu berhasil ditambahkan'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 500,
                'message' => 'Gagal menambahkan menu: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    { 
        $menu = Menu::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|string|max:100',
            'image' => 'nullable|image|max:2048',
            'is_home' => 'nullable|boolean',
            'diskon' => 'nullable|integer',
        ]);

        $menu->name = $validated['name'];
        $menu->description = $validated['description'] ?? null;
        $menu->price = $validated['price'];
        $menu->category_id = $validated['category_id'] ?? null;
        $menu->diskon = $request->diskon ?? null;
        $menu->is_home = $request->is_home ?? 0;

        if ($request->hasFile('image')) {
            // Hapus file lama jika ada
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            $path = $request->file('image')->store('menus', 'public');
            $menu->image = $path;
        }

        $menu->save();

        return response()->json(['status' => 200, 'message' => 'Menu berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return response()->json(['status' => 200, 'message' => 'Menu berhasil dihapus']);
    }
}
