<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AnnouncementModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\AnnouncementResource;

class AnnouncementController extends Controller
{
    public function store(Request $request){

        $mail =  Validator::make($request->all(),[
            'subject' => 'required|string|max:255',
            'body' => 'required'
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
            $announcement = AnnouncementModel::create([
                'subject' => $request['subject'], 
                'body' => $request['body'], 
        
            ]);
        
            return response()->json([
                'message'=> 'ANNOUNCEMENT SENT AND ADDED',
                'quack' => true,
                'data'=> new AnnouncementResource($announcement)
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

            $announcement = AnnouncementModel::all();
            return AnnouncementResource::collection($announcement);
    }
    public function destroy(AnnouncementModel $announcement)
    {

        $announcement->delete();
       
        return response()->json([
            'message'=> 'ANNOUNCEMENT DELETED',
            'quack' => true,
        ],200);
    }
}
