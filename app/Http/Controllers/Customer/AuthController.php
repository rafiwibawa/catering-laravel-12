<?php

namespace App\Http\Controllers\Customer;

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
        return view('customer.auth.login');
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

        $user = User::where('email', $request->email)->where('role', 'customer')->first(); 
         
        if ($user && Auth::attempt($login)) {
            return redirect('/menu');
        }else{ 
            return Redirect::back()->withErrors(['message' => 'Login failed!, check your username and password.'])->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
    
    public function register()
    {  
        return view('customer.auth.register');
    }

    public function storeRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => ['required', 'regex:/^\d{12}$/'],
            'address' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);        

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);

        Customer::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);    

        $login = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $user = User::where('email', $request->email)->first(); 
         
        if ($user && Auth::attempt($login)) {
            return redirect('/menu');
        }else{  
            return redirect('/login');
        }
    }
}
