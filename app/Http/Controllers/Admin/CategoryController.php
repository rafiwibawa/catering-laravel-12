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

    public function list()
    {
        return response()->json(Category::select('id', 'name')->get());
    }
}
