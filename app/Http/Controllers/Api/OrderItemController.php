<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderItemController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OrderItem::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'order_id'=>'required|exists:orders,id',
            'food_item_id'=>'required',
            'quantity'=>'required|numeric|min:0',
            'price'=>'required|numeric|min:0',
        ]);
        if($validated->fails()){
            return response()->json($validated->errors() , 400);
        }

            $order = OrderItem::create([
            'order_id'=>$request->order_id,
            'food_item_id'=>$request->food_item_id,
            'quantity'=>$request->quantity,
            'price'=>$request->price,
            ]);

            return response()->json($order , 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderItem $orderItem)
    {
        return response()->json($orderItem);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderItem $orderItem)
    {

        $validated = Validator::make($request->all() , [

            'order_id'=>'required|exists:orders,id',
            'food_item_id'=>'required',
            'quantity'=>'required|numeric|min:0',
            'price'=>'required|numeric|min:0',
        ]);
        if($validated->fails()){
            return response()->json($validated->errors() , 400);
        }

            $orderItem->update([
            'order_id'=>$request->order_id,
            'food_item_id'=>$request->food_item_id,
            'quantity'=>$request->quantity,
            'price'=>$request->price,
            ]);

            return response()->json($orderItem);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderItem $orderItem)
    {
        $orderItem->delete();
        return response()->json(['message'=>'deleted successfully']);
    }
}
