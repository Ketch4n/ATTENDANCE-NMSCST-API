<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ScheduleModel;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleResource;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    public function store(Request $request){

        $mail =  Validator::make($request->all(),[

                "establishment_id" => 'required|integer|max:11',
                "user_id" => 'required|integer|max:11',
                "in_am"=>'required',
                "out_am"=>'required',
                "in_pm"=>'required',
                "out_pm"=>'required'
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
            $schedule = ScheduleModel::create([

                "establishment_id" =>  $request['establishment_id'], 
                "user_id" => $request['user_id'],
                "in_am"=> $request['in_am'], 
                "out_am"=> $request['out_am'], 
                "in_pm"=> $request['in_pm'], 
                "out_pm"=> $request['out_pm'], 
        
            ]);
        
            return response()->json([
                'message'=> 'SCHEDULE ADDED',
                'quack' => true,
                'data'=> new ScheduleResource($schedule)
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

            $schedule = ScheduleModel::all();
            return ScheduleResource::collection($schedule);
    }
    public function destroy(ScheduleModel $schedule)
    {

        $schedule->delete();
       
        return response()->json([
            'message'=> 'SCHEDULE DELETED',
            'quack' => true,
        ],200);
    }
}
