<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function login(Request $request){

        $userDetails = $request->validate([
            // 'username'=> ['required'],
            'email'=> ['required','email'],
            'password'=> ['required']
        ]);
        

        if (auth()->attempt(['email'=> $userDetails['email'],'password'=>$userDetails['password']]))
        {
            $user = auth()->user();
            return response()->json([
                'quack' => true,
                'message'=> 'Login Success',
                'user' => $user
            ], 200);
        }
        else
        {
            return response()->json([
                'quack'=>false,
                'message' => 'Username or password invalid',
                'user'=>[]
            ], 401);
        }
    }
    public function registerUser(Request $request)
    {

        $userDetails = $request->validate([
            'name'=> 'required|string|max:255',
            'email'=> 'required|email|unique:users,email',
            'role'=> 'required|integer',
            'password'=> 'required|string|max:255',
            'course' => 'required|string',
            'section' => 'required|string|max:255',
            'semester' => 'required|string',
            'school_year' => 'required|string|max:9',
            'id_number' => 'required|string',
            'contact_number' => 'required|string|max:255',
            'status' => 'required|integer',
        ]);

        $userDetails['password'] = bcrypt($userDetails['password']);


        try {
            $user = User::create($userDetails);
            return response()->json([
                'quack'=> true,
                'message' => 'Users registered successfully',
                // 'user' => $admin
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'quack'=> false,
                'message' => 'User registration failed',
                // 'quack' => $e->getMessage()
            ], 500);
        } 
    }
   
}

