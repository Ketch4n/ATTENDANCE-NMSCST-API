<?php

namespace App\Http\Controllers\Api;

use App\Models\DTRModel;
use Illuminate\Http\Request;
use App\Http\Resources\DTRResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DTRController extends Controller
{
    public function store(Request $request){

        $mail =  Validator::make($request->all(),[

                'user_id' => 'required|integer|max:11',
                'establishment_id' => 'required|integer|max:11',
                'in_am'=>'required',
                'out_am'=>'required',
                'in_pm'=>'required',
                'out_pm'=>'required',

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
            $dtr = DTRModel::create([

                'user_id' => $request['user_id'], 
                'establishment_id' => $request['establishment_id'], 
                'in_am'=>$request['in_am'],
                'out_am'=>$request['out_am'], 
                'in_pm'=>$request['in_pm'], 
                'out_pm'=>$request['out_pm'], 

        
            ]);
        
            return response()->json([
                'message'=> 'DTR ADDED',
                'quack' => true,
                'data'=> new DTRResource($dtr)
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

            $dtr = DTRModel::all();
            return DTRResource::collection($dtr);
    }
    public function destroy(DTRModel $dtr)
    {

        $dtr->delete();
       
        return response()->json([
            'message'=> 'DTR DELETED',
            'quack' => true,
        ],200);
    }
}
