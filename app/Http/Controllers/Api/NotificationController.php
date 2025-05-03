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
    public function index(Request $request , string $id)
    {
        $status = $request->get('status', 'all');

        if ($status == 'unread') {
            $notifications = Notification::where('is_read', false)
            ->where('user_id',$id)->get();
        } elseif ($status == 'read') {
            $notifications = Notification::where('is_read', true)
            ->where('user_id' ,$id)->get();
        } else {
            $notifications = Notification::where('user_id' ,$id)->get();
        }

        return response()->json($notifications);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'user_id'=>'required|numeric',
            'message'=>'required|max:255',
            'title' => 'required|string|max:255',
            'is_read'=>'required|boolean',
            'read_at'=>'required|date',
        ]);

        if($validated->fails()){
            return response()->json($validated->errors() , 400);
        }

        $notification = Notification::create([
                'user_id'=>$request->user_id,
                'message'=>$request->message,
                'title' => $request->title,
                'is_read'=>$request->is_read,
                'read_at'=>$request->read_at,
            ]);

            return response()->json($notification , 201);
    }

    /**
     * Mark a notification as read.
     */
    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update([
            'is_read' => true,
            'read_at' => now(),
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
