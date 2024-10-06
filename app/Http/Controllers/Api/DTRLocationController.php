<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\DTRLocationModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\DTRLocationResource;
use App\Http\Controllers\Api\DTRLocationController;

class DTRLocationController extends Controller
{
    public function store(Request $request){

        $validate =  Validator::make($request->all(),[

                'dtr_id' => 'required|integer',

                "in_am_latitude"=>'required',
                "in_am_longitude"=>'required',

                "out_am_latitude"=>'required',
                "out_am_longitude"=>'required',

                "in_pm_latitude"=>'required',
                "in_pm_longitude"=>'required',

                "out_pm_latitude"=>'required',
                "out_pm_longitude"=>'required',

        ]);

        if ($validate->fails())
        {
            return response()->json([
                'message'=>'ALL FIELDS ARE REQUIRED',
                'quack'=> false,
                'error'=>$validate->messages(),
            ],422);
                
        }

        try 
        {
            $dtrlocation = DTRLocationModel::create([

                'dtr_id' => $request['dtr_id'], 
                
                "in_am_latitude"=>$request['in_am_latitude'],
                "in_am_longitude"=>$request['in_am_longitude'],

                "out_am_latitude"=>$request['out_am_latitude'],
                "out_am_longitude"=>$request['out_am_longitude'],

                "in_pm_latitude"=>$request['in_pm_latitude'],
                "in_pm_longitude"=>$request['in_pm_longitude'],

                "out_pm_latitude"=>$request['out_pm_latitude'],
                "out_pm_longitude"=>$request['out_pm_longitude'],

        
            ]);
        
            return response()->json([
                'message'=> 'DTR LOCATION ADDED',
                'quack' => true,
                'data'=> new DTRLocationResource($dtrlocation)
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

            $dtrlocation = DTRLocationModel::all();
            return DTRLocationResource::collection($dtrlocation);
    }
    public function destroy(DTRLocationModel $dtrlocation)
    {

        $dtrlocation->delete();
       
        return response()->json([
            'message'=> 'DTR LOCATION DELETED',
            'quack' => true,
        ],200);
    }
}
