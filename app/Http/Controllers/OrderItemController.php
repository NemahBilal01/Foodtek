<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function index()
    {
        $orderItems = OrderItem::all();
        return view('orderItems.index',compact('orderItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orderItems.create');
    }

    /**
     * Store a newly created resource in storage.
     * Create a New Order Item
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'food_item_id' => 'required|exists:food_items,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);
    
        $orderItem = OrderItem::create($validated);
    
        return redirect()->route('orderItems.index')->with('success', 'Order item created successfully.');
    }

    /**
     * Display the specified resource.
     * display a Specific Order Item
     */
    public function show(string $id)
    {
        {
            $orderItem = OrderItem::with(['foodItem', 'order'])->findOrFail($id);
            return response()->json($orderItem);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $orderItem = OrderItem::findOrFail($id);
        return view('orderitems.edit', compact('orderItem'));
    }

    /**
     * Update the specified resource in storage.
     * Update an Order Item
     */
    public function update(Request $request, string $id)
    {
        $orderItem = OrderItem::findOrFail($id);
    
        $validated = $request->validate([
            'quantity' => 'sometimes|integer|min:1',
            'price' => 'sometimes|numeric|min:0',
        ]);
    
        $orderItem->update($validated);
    
        return redirect()->route('orderItems.index')->with('success', 'Order item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * will delete an order item from the database.
     */
    public function destroy(string $id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->delete();
    
        return redirect()->route('orderItems.index')->with('success', 'Order item deleted successfully.');
    }
}
