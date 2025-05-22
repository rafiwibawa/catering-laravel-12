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
        dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:100',
            'image' => 'nullable|image|max:2048', // max 2MB
        ]);

        $menu = new Menu();
        $menu->name = $validated['name'];
        $menu->description = $validated['description'] ?? null;
        $menu->price = $validated['price'];
        $menu->category = $validated['category'] ?? null;
        $menu->created_by = Auth::id();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('menus', 'public');
            $menu->image = $path;
        }

        $menu->save();

        return response()->json(['status' => 200, 'message' => 'Menu berhasil ditambahkan']);
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:100',
            'image' => 'nullable|image|max:2048',
        ]);

        $menu->name = $validated['name'];
        $menu->description = $validated['description'] ?? null;
        $menu->price = $validated['price'];
        $menu->category = $validated['category'] ?? null;

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
