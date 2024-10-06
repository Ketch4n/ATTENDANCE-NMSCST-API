<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\FaceDataModel;
use App\Http\Controllers\Controller;
use App\Http\Resources\FaceDataResource;
use Illuminate\Support\Facades\Validator;

class FaceDataController extends Controller
{
    public function store(Request $request){

        $mail =  Validator::make($request->all(),[

                'user_id' => 'required|integer|max:11',
                'user_email' => 'required|string|max:255|email',
                'model_data'=>'required',
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
            $facedata = FaceDataModel::create([

                "user_id"=> $request['user_id'], 
                "user_email"=> $request['user_email'], 
                "model_data"=> $request['model_data'], 
        
            ]);
        
            return response()->json([
                'message'=> 'FACE DATA ADDED',
                'quack' => true,
                'data'=> new FaceDataResource($facedata)
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

            $facedata = FaceDataModel::all();
            return FaceDataResource::collection($facedata);
    }
    public function destroy(FaceDataModel $facedata)
    {

        $facedata->delete();
       
        return response()->json([
            'message'=> 'FACE DATA DELETED',
            'quack' => true,
        ],200);
    }
}
