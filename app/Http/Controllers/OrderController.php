<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //Filtering & Sorting orders
    public function index(Request $request)
    {
        $query = Order::query();
    
        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }
    
        $orders = $query->get();
    
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     * creating a new order
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'restaurant_id' => 'required|exists:restaurants,id',
            'status' => 'required|in:pending,processing,completed,cancelled',
            'total_price' => 'required|numeric|min:0',
            'payment_status' => 'required|in:unpaid,paid',
        ]);
    
        $order = Order::create($validated);
    
        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     * To show the details & to include related models ('items', 'payment', 'latestStatus')
     */
    public function show(string $id)
    {
        $order = Order::with('items', 'payment', 'latestStatus')->findOrFail($id);
        return response()->json($order);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     * to modify an existing order
     */
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);
    
        $validated = $request->validate([
            'status' => 'sometimes|in:pending,processing,completed,cancelled',
            'total_price' => 'sometimes|numeric|min:0',
            'payment_status' => 'sometimes|in:unpaid,paid',
        ]);
    
        $order->update($validated);
    
        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * to delete an order
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete(); // Soft delete by default
    
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
