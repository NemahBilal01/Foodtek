<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Order::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = Validator::make($request->all(), [
            'user_id'=>'required|exists:users,id',
            'status'=>'required|in:pending,processing,completed,cancelled',
            'total_price'=>'required|numeric|min:0',
            'payment_status'=>'required|in:unpaid,paid,failed',
            'restaurant_id'=>'required|exists:restaurants,id',
        ]);
        if($validated->fails()){
            return response()->json($validated->errors() , 400);
        }



            $order = Order::create([
            'user_id'=>$request->user_id,
            'status'=>$request->status,
            'total_price'=>$request->total_price,
            'payment_status'=>$request->payment_status,
            'restaurant_id'=>$request->restaurant_id,
            ]);

            return response()->json($order , 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = Validator::make($request->all() , [
            'user_id'=>'required|exists:users,id',
            'status'=>'required|in:pending,processing,completed,cancelled',
            'total_price'=>'required|numeric|min:0',
            'payment_status'=>'required|in:unpaid,paid,failed',
            'restaurant_id'=>'required|exists:restaurants,id',
        ]);
        if($validated->fails()){
            return response()->json($validated->errors() , 400);
        }

            $order->update([
                'user_id'=>$request->user_id,
                'status'=>$request->status,
                'total_price'=>$request->total_price,
                'payment_status'=>$request->payment_status,
                'restaurant_id'=>$request->restaurant_id,
            ]);

            return response()->json($order);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(['message'=>'deleted successfully']);
    }
}
