<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DeliveryTracking;
use Illuminate\Http\Request;
use App\Events\DeliveryLocationUpdated;


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
        $request->validate([
            'order_id' => 'required|integer',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'last_updated_at' => 'required|date',
        ]);
    
        $tracking = DeliveryTracking::create($request->all());
    
        event(new DeliveryLocationUpdated(
            $tracking->order_id,
            $tracking->latitude,
            $tracking->longitude
        ));
    
        return response()->json(['message' => 'Delivery Tracking created successfully.','data' => $tracking], 201);
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
        $request->validate([
            'order_id' => 'required|integer',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'last_updated_at' => 'required|date',
        ]);
    
        $deliveryTrack = DeliveryTracking::findOrFail($id);
        $deliveryTrack->update($request->all());
    
        event(new DeliveryLocationUpdated(
            $deliveryTrack->order_id,
            $deliveryTrack->latitude,
            $deliveryTrack->longitude
        ));
        return response()->json(['message' => 'Delivery Tracking created successfully.','data' => $deliveryTrack], 201);
        
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
