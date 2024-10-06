<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\EstablishmentModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\EstablishmentResource;

class EstablishmentController extends Controller
{
    public function store(Request $request){

        $mail =  Validator::make($request->all(),[
                'establishment_name'=> 'required|string|max:255',
                'latitude'=> 'required|string|max:255',
                'longitude'=> 'required|string|max:255',
                'location'=> 'required|string|max:255',
                'hours_required'=> 'required',
                'radius'=> 'required|integer|max:11',
                'status'=> 'required|integer|max:11',
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
            $establishment = EstablishmentModel::create([
             
                'establishment_name'=> $request['establishment_name'], 
                'latitude'=> $request['latitude'], 
                'longitude'=> $request['longitude'], 
                'location'=> $request['location'], 
                'hours_required'=> $request['hours_required'], 
                'radius'=> $request['radius'], 
                'status'=> $request['status'], 
        
            ]);
        
            return response()->json([
                'message'=> 'ESTABLISHMENT ADDED',
                'quack' => true,
                'data'=> new EstablishmentResource($establishment)
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

            $establishment = EstablishmentModel::all();
            return EstablishmentResource::collection($establishment);
    }
    public function destroy(EstablishmentModel $establishment)
    {

        $establishment->delete();
       
        return response()->json([
            'message'=> 'ESTABLISHMENT DELETED',
            'quack' => true,
        ],200);
    }
}
