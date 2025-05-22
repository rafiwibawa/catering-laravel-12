<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Customer;

use Hash;
use Redirect;
use Auth;

class AuthController extends BaseApiController
{  
    public function login(Request $request)
    {
        try { 
            $validated = $request->validate([ 
                'email' => 'required|email',
                'password' => 'required',
            ]);  

            $user = User::where('email', $validated['email'])->first();

            if (! $user || ! Hash::check($validated['password'], $user->password)) {
                return $this->sendErrorResponse(false, "Login failed", ['message' => 'Invalid credentials'], 401);
            }

            $data = [
                'user' => $user,
                'token' => $user->createToken('api-token')->plainTextToken,
            ];

            return $this->sendSuccessResponse(true, "Login Success", $data, 200);
        } catch (\Throwable $e) {
            return $this->sendErrorResponse(false, "Login failed", ['exception' => $e->getMessage()], 500);
        }
    }

    public function Register(Request $request)
    {   
        try { 

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

            $data = [
                'user' => $user,
                'token' => $user->createToken('api-token')->plainTextToken
            ];

            return $this->sendSuccessResponse(true, "Register Success", $data, 200);
        } catch (\Exception $e) {
            // Bisa log error juga: Log::error($e->getMessage()); 
            return $this->sendErrorResponse(false, "Login failed", ['exception' => $e->getMessage()], 500);
        }
    }
}
