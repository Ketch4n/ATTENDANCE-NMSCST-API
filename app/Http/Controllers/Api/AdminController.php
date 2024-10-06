<?php

namespace App\Http\Controllers\Api;

use App\Models\AdminModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $userDetails = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        // Attempt to authenticate the admin
        if (auth()->guard('admin')->attempt(['email' => $userDetails['email'], 'password' => $userDetails['password']])) {
            $admin = auth()->guard('admin')->user();
            return response()->json([
                'quack' => true,
                'message' => 'Login Success',
                'user' => $admin
            ], 200);
        } else {
            return response()->json([
                'quack' => false,
                'message' => 'Email or Password invalid',
                'user' => []
            ], 401);
        }
    }

    public function register(Request $request){

        $userDetails = $request->validate([
            'name'=> 'required|string|max:255',
            'email'=> 'required|email|unique:admin,email',
            'role'=> 'required|integer',
            'password'=> 'required|string|max:255'
        ]);

        $userDetails['password'] = bcrypt($userDetails['password']);

        try {
            $admin = AdminModel::create($userDetails);
            return response()->json([
                'quack'=> true,
                'message' => 'Admin registered successfully',
                // 'user' => $admin
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'quack'=> false,
                'message' => 'Admin registration failed',
                // 'quack' => $e->getMessage()
            ], 500);
        } 
    }
}
