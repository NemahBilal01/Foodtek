<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $id)
    {
        $status = $request->get('status', 'all');

        if ($status == 'unread') {
            $notifications = Notification::where('user_id', $id)->where('is_read', false)->get();
        } elseif ($status == 'read') {
            $notifications = Notification::where('user_id', $id)->where('is_read', true)->get();
        } else {
            $notifications = Notification::where('user_id', $id)->get();
        }

        return NotificationResource::collection($notifications);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:users,id',
            'message' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'is_read' => 'required|boolean',
            'read_at' => 'nullable|date',
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 400);
        }

        $notification = Notification::create($validated->validated());

        return new NotificationResource($notification);
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

        return new NotificationResource($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        $notification->delete();
        return response()->json(['message' => 'Notification deleted successfully.']);
    }
}
