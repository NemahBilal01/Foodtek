<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DeliveryStatus;
use Illuminate\Http\Request;

class DeliveryStatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return DeliveryStatus::all();
        return response()->json(DeliveryStatus::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id'=>'required|exists:orders,id',
            'status' => 'required|in:pending,dispatched,out_for_delivery,delivered'
        ]);
        $deliveryStatues = DeliveryStatus::create($validated);
        return response()->json($deliveryStatues,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $deliveryStatues = DeliveryStatus::findOrFail($id);
        return response()->json($deliveryStatues);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $deliveryStatues = DeliveryStatus::findOrFail($id);
        $validated = $request->validate([
            'order_id'=>'sometimes|exists:orders,id',
            'status' => 'sometimes|in:pending,dispatched,out_for_delivery,delivered',
        ]);
        $deliveryStatues->update($validated);
        return response()->json($deliveryStatues);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deliveryStatues = DeliveryStatus::findOrFail($id);
        $deliveryStatues->delete();
        return response()->json(['message'=>'Delivery Statues deleted successfully'],200);
    }
}
