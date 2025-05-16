<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderItemResource;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderItemController extends Controller
{
    public function index()
    {
        $orderItems = OrderItem::all();
        return OrderItemResource::collection($orderItems);
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'food_item_id' => 'required',
            'quantity' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 400);
        }

        $orderItem = OrderItem::create($validated->validated());

        return new OrderItemResource($orderItem);
    }

    public function show(OrderItem $orderItem)
    {
        return new OrderItemResource($orderItem);
    }

    public function update(Request $request, OrderItem $orderItem)
    {
        $validated = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'food_item_id' => 'required',
            'quantity' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 400);
        }

        $orderItem->update($validated->validated());

        return new OrderItemResource($orderItem);
    }

    public function destroy(OrderItem $orderItem)
    {
        $orderItem->delete();
        return response()->json(['message' => 'Order item deleted successfully.']);
    }
}
