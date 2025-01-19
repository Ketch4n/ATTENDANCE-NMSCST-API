<?php

namespace App\Http\Controllers\api;

use App\Models\ProgramModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProgramResource;
use Illuminate\Support\Facades\Validator;

class ProgramController extends Controller
{

    private function validateCourse(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'COURSE FIELD REQUIRED',
                'quack' => false,
                'error' => $validator->messages(),
            ], 422);
        }

        return null;
    }


    public function store(Request $request){

        $validationResponse = $this->validateCourse($request);
        if ($validationResponse) {
            return $validationResponse;
        }

        try 
        {
            $course =  ProgramModel::create([
                'course' => $request['course'], 
              
        
            ]);
        
            return response()->json([
                'message'=> 'COURSE ADDED',
                'quack' => true,
                'data'=> new ProgramResource($course)
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

    public function update(Request $request, ProgramModel $course)
    {
        $validationResponse = $this->validateCourse($request);
        if ($validationResponse) {
            return $validationResponse;
        }

        try {
            $course->update([
                'course' => $request['course'],
            ]);

            return response()->json([
                'message' => 'COURSE UPDATED',
                'quack' => true,
                'data' => new ProgramResource($course),
            ], 200);
        }
        
        catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'quack' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function index(){

            $course =  ProgramModel::all();
            return ProgramResource::collection($course);
    }
    
    public function destroy( ProgramModel $course)
    {

        $course->delete();
       
        return response()->json([
            'message'=> 'COURSE DELETED',
            'quack' => true,
        ],200);
    }
}
