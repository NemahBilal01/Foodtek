<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeliveryStatusResource;
use App\Models\DeliveryStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeliveryStatusesController extends Controller
{
    public function index()
    {
        return DeliveryStatusResource::collection(DeliveryStatus::all());
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'status' => 'required|in:pending,dispatched,out_for_delivery,delivered',
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }

        $deliveryStatus = DeliveryStatus::create([
            'order_id' => $request->order_id,
            'status' => $request->status,
        ]);

        return new DeliveryStatusResource($deliveryStatus);
    }

    public function show(string $id)
    {
        $deliveryStatus = DeliveryStatus::findOrFail($id);
        return new DeliveryStatusResource($deliveryStatus);
    }

    public function update(Request $request, string $id)
    {
        $deliveryStatus = DeliveryStatus::findOrFail($id);

        $validated = Validator::make($request->all(), [
            'order_id' => 'sometimes|exists:orders,id',
            'status' => 'sometimes|in:pending,dispatched,out_for_delivery,delivered',
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }

        $deliveryStatus->update($request->only(['order_id', 'status']));
        return new DeliveryStatusResource($deliveryStatus);
    }

    public function destroy(string $id)
    {
        $deliveryStatus = DeliveryStatus::findOrFail($id);
        $deliveryStatus->delete();

        return response()->json(['message' => 'Delivery Status deleted successfully.'], 200);
    }
}
