<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AccomplishmentModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\AccomplishmentResource;

class AccomplishmentController extends Controller
{
    public function store(Request $request){

        $mail =  Validator::make($request->all(),[

                'user_id' => 'required|integer|max:11',
                'establishment_id' => 'required|integer|max:11',
                'week'=>'required|string|max:255',
                'report'=>'required'
        ]);

        if ($mail->fails())
        {
            return response()->json([
                'message'=>'ALL FIELDS ARE REQUIRED',
                'quack'=> false,
                'error'=>$mail->messages(),
            ],422);
                
        }

        try 
        {
            $accomplishment = AccomplishmentModel::create([

                'user_id' => $request['user_id'], 
                'establishment_id' => $request['establishment_id'], 
                'week'=>$request['week'], 
                'report'=>$request['report'], 
        
            ]);
        
            return response()->json([
                'message'=> 'ACCOMPLISHMENT ADDED',
                'quack' => true,
                'data'=> new AccomplishmentResource($accomplishment)
            ], 200);
        }
        
        catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'quack' => false,
                'error' => $e->getMessage()
            ], 500); 
        }

    }
    public function index(){

            $accomplishment = AccomplishmentModel::all();
            return AccomplishmentResource::collection($accomplishment);
    }
    public function destroy(AccomplishmentModel $accomplishment)
    {

        $accomplishment->delete();
       
        return response()->json([
            'message'=> 'ACCOMPLISHMENT DELETED',
            'quack' => true,
        ],200);
    }
}
