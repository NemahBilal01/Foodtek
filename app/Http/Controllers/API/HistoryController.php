<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class HistoryController extends Controller
{
    public function getUserOrders(string $user_id){
        $orders = Order::with(['items', 'foodItems'])
            ->where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return OrderResource::collection($orders);
    }
}
