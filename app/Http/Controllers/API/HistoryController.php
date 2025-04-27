<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function getUserOrders(string $user_id){
        $orders = Order::with('items' ,'foodItems' )->where('user_id' , $user_id)
        ->orderBy('created_at','desc')->get();

        return response()->json($orders);
    }

    public function reOrder(string $food_id ,string $user_id ){

        $cart = CartItem::updateOrCreate([
            'food_item_id'=>$food_id,
            'user_id'=>$user_id,
            'quantity'=>1,
        ]); 

        return response()->json(['message' => 'Food item re-added to cart']);

    }
}
