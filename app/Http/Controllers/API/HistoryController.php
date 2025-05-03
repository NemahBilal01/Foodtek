<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function getUserOrders(string $user_id){
        $orders = Order::with('items' ,'foodItems' )->where('orders.user_id' , $user_id)
        ->orderBy('created_at','desc')->get();

        return response()->json($orders);
    }



    // public function reOrder(string $food_id ,string $user_id ){

    //     $order = Order::with('orderItems')->findOrFail($orderId);


    // foreach ($order->orderItems as $item) {
    //     // Check if the product already exists in the user's cart
    //     $existingCartItem = CartItem::where('user_id', $userId)
    //         ->where('product_id', $item->product_id)
    //         ->first();

    //     if ($existingCartItem) {
    //         // If it exists, increment quantity
    //         $existingCartItem->quantity += $item->quantity;
    //         $existingCartItem->save();
    //     } else {
    //         // Otherwise, create a new cart item
    //         CartItem::create([
    //             'user_id' => $userId,
    //             'product_id' => $item->product_id,
    //             'quantity' => $item->quantity,
    //         ]);
    //     }
    // }

    // return response()->json(['message' => 'Order re-added to cart.']);

    // }
}
