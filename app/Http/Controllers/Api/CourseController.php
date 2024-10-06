<?php

namespace App\Http\Controllers\Api;

use App\Models\CourseModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function store(Request $request){

        $mail =  Validator::make($request->all(),[
            'course' => 'required|string|max:255',
        ]);

        if ($mail->fails())
        {
            return response()->json([
                'message'=>'COURSE FIELD REQUIRED',
                'quack'=> false,
                'error'=>$mail->messages(),
            ],422);
                
        }

        try 
        {
            $course =  CourseModel::create([
                'course' => $request['course'], 
              
        
            ]);
        
            return response()->json([
                'message'=> 'COURSE ADDED',
                'quack' => true,
                'data'=> new CourseResource($course)
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

            $course =  CourseModel::all();
            return CourseResource::collection($course);
    }
    public function destroy( CourseModel $course)
    {

        $course->delete();
       
        return response()->json([
            'message'=> 'COURSE DELETED',
            'quack' => true,
        ],200);
    }
}
