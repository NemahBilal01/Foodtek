<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ChatResource;

class ChatController extends Controller
{
    public function store(Request $request, $orderId)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        $order = Order::findOrFail($orderId);
        $request->validate(['message' => 'required|string|max:255']);
    
        $chat = new Chat;
        $chat->order_id = $order->id;
        $chat->sender_id = Auth::id();
        $chat->sender_type = 'client';
        $chat->message = $request->message;
        $chat->save();
    
        return new ChatResource($chat);
    }



    public function archiveChat($orderId)
    {
        
        Chat::where('order_id', $orderId)->update(['is_archived' => true]);
        return response()->json(['message' => 'Chat archived.']);
    }
    

    private function getDriverId($orderId)
    {
        $order = Order::findOrFail($orderId);
        return $order->driver_id ?? 1;
    }
}
