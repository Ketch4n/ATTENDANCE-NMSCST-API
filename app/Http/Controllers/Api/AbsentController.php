<?php

namespace App\Http\Controllers\Api;

use App\Models\AbsentModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AbsentResource;
use Illuminate\Support\Facades\Validator;

class AbsentController extends Controller
{
    public function store(Request $request){

        $mail =  Validator::make($request->all(),[

                "user_id"=> 'required|integer|max:11',
                "establishment_id"=> 'required|integer|max:11',
                "reason"=>'required',
                "status"=> 'required|integer|max:11',
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
            $absent = AbsentModel::create([

                'user_id' => $request['user_id'], 
                'establishment_id' => $request['establishment_id'], 
                'reason'=>$request['reason'], 
                'status'=>$request['status'], 
        
            ]);
        
            return response()->json([
                'message'=> 'ABSENT ADDED',
                'quack' => true,
                'data'=> new AbsentResource($absent)
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

            $absent = AbsentModel::all();
            return AbsentResource::collection($absent);
    }
    public function destroy(AbsentModel $absent)
    {

        $absent->delete();
       
        return response()->json([
            'message'=> 'ABSENT DELETED',
            'quack' => true,
        ],200);
    }
}
