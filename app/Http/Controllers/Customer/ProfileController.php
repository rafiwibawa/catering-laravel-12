<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {  
        $user = User::where('id', Auth::user()->id)->with('customer')->first();
        return view('customer.profile.index', compact('user'));
    }
}
