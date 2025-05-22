<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Customer;

use Hash;
use Redirect;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {   
        return view('admin.dashboard.index');
    } 
}
