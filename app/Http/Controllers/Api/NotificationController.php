<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Notification::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'user_id'=>'required|numeric',
            'message'=>'required|max:255',
            'is_read'=>'required|boolean',
            'read_at'=>'required|date',
        ]);
        if($validated->fails()){
            return response()->json($validated->errors() , 400);
        }



        $notification = Notification::create([
                'user_id'=>$request->user_id,
                'message'=>$request->message,
                'is_read'=>$request->is_read,
                'read_at'=>$request->read_at,
            ]);

            return response()->json($notification , 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification)
    {
        return response()->json($notification);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notification $notification)
    {

        $validated = Validator::make($request->all(), [
            'user_id'=>'required|numeric',
            'message'=>'required|max:255',
            'is_read'=>'required|boolean',
            'read_at'=>'required',
        ]);

        if($validated->fails()){
            return response()->json($validated->errors() , 400);
        }

            $notification->update([
                'user_id'=>$request->user_id,
                'message'=>$request->message,
                'is_read'=>$request->is_read,
                'read_at'=>$request->read_at,
            ]);

            return response()->json($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        $notification->delete();
        return response()->json(['message'=>'Deleted Successfully']);
    }
}
