<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Models\AdminModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    public function checkEmail(Request $request)
    {
      
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid email format',
            ], 400);
        }

        $email = $request->email;

       
        $emailExists = User::where('email', $email)->exists() || 
                       AdminModel::where('email', $email)->exists();

        if ($emailExists) {
            return response()->json([
                'message' => 'Email is already in use',
            ], 200);
        }

        return response()->json([
            'message' => 'Email is available',
        ], 200);
    }
}
