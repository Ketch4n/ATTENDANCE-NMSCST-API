<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\SchoolYearModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\SchoolYearResource;

class SchoolYearController extends Controller
{
    public function index(){

        $schedule = SchoolYearModel::all();
        return SchoolYearResource::collection($schedule);

    }
    public function store(Request $request){

        $sy =  Validator::make($request->all(),[

                "school_year" => 'required|string|max:9',
        ]);

        if ($sy->fails())
        {
            return response()->json([
                'message'=>'ALL FIELDS ARE REQUIRED',
                'quack'=> false,
                'error'=>$sy->messages(),
            ],422);
                
        }

        try 
        {
            $year = SchoolYearModel::create([

                "school_year" =>  $request['school_year'],  
        
            ]);
        
            return response()->json([
                'message'=> 'SCHOOL YEAR ADDED',
                'quack' => true,
                'data'=> new SchoolYearResource($year)
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

    public function update(Request $request, $id)
    {
        $sy = Validator::make($request->all(), [
            "school_year" => 'required|string|max:9',
        ]);

        if ($sy->fails()) {
            return response()->json([
                'message' => 'ALL FIELDS ARE REQUIRED',
                'quack' => false,
                'error' => $sy->messages(),
            ], 422);
        }

        try {
            $year = SchoolYearModel::findOrFail($id);
            $year->update([
                "school_year" => $request['school_year'],
            ]);

            return response()->json([
                'message' => 'SCHOOL YEAR UPDATED',
                'quack' => true,
                'data' => new SchoolYearResource($year)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'quack' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $post = SchoolYearModel::find($id);
       
        if (!$post) {
            return response()->json([
                'message' => 'SCHOOL YEAR NOT FOUND.'
            ], 404);
        }
        $post->delete();

        return response()->json([
            'message' => 'SCHOOL YEAR DELETED.'
        ], 200);
    }

}
