<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Customer;

use Hash;
use Redirect;
use Auth;

class AuthController extends Controller
{
    public function index()
    {   
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $login = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $user = User::where('email', $request->email)->where('role', 'admin')->first(); 
         
        if ($user && Auth::attempt($login)) { 
            return redirect('/admin/dashboard');
        }else{ 
            return Redirect::back()->withErrors(['message' => 'Login failed!, check your username and password.'])->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }
}
