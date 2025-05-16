<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeliveryTrackingResource;
use App\Models\DeliveryTracking;
use Illuminate\Http\Request;
use App\Events\DeliveryLocationUpdated;

class DeliveryTrackingController extends Controller
{
    public function index()
    {
        return DeliveryTrackingResource::collection(DeliveryTracking::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|integer',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'last_updated_at' => 'required|date',
        ]);

        $tracking = DeliveryTracking::create($validated);

        event(new DeliveryLocationUpdated(
            $tracking->order_id,
            $tracking->latitude,
            $tracking->longitude
        ));

        return (new DeliveryTrackingResource($tracking))
            ->additional(['message' => 'Delivery Tracking created successfully.']);
    }

    public function show(string $id)
    {
        $deliveryTracking = DeliveryTracking::findOrFail($id);
        return new DeliveryTrackingResource($deliveryTracking);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'order_id' => 'required|integer',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'last_updated_at' => 'required|date',
        ]);

        $deliveryTrack = DeliveryTracking::findOrFail($id);
        $deliveryTrack->update($validated);

        event(new DeliveryLocationUpdated(
            $deliveryTrack->order_id,
            $deliveryTrack->latitude,
            $deliveryTrack->longitude
        ));

        return (new DeliveryTrackingResource($deliveryTrack))
            ->additional(['message' => 'Delivery Tracking updated successfully.']);
    }

    public function destroy(string $id)
    {
        $deliveryTracking = DeliveryTracking::findOrFail($id);
        $deliveryTracking->delete();

        return response()->json(['message' => 'Delivery Tracking deleted successfully.'], 200);
    }
}
