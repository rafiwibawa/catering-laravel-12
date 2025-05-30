<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Menu;

class HomeController extends Controller
{
    public function index()
    { 
        $page = true;  
        $menu = Menu::where('is_home', '1')->get();
        return view('customer.home.index', compact('page', 'menu'));
    }
}
