<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
