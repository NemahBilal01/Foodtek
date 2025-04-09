<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DeliveryTracking;
use Illuminate\Http\Request;

class DeliveryTrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DeliveryTracking::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);
        $deliveryTracking = DeliveryTracking::create($validated);
        return response()->json($deliveryTracking,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $deliveryTracking = DeliveryTracking::findOrFail($id);
        return response()->json($deliveryTracking);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $deliveryTracking = DeliveryTracking::findOrFail($id);
        $validated = $request->validate([
            'order_id' => 'sometimes|exists:orders,id',
            'latitude' => 'sometimes|numeric|between:-90,90',
            'longitude' => 'sometimes|numeric|between:-180,180',
        ]);
        $deliveryTracking->update($validated);
        return response()->json($deliveryTracking);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deliveryTracking = DeliveryTracking::findOrFail($id);
        $deliveryTracking->delete();
        return response()->json(['message'=>'Delivery Tracking deleted successfully.'],200);
    }
}
