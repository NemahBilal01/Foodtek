<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Notifications\OrderRated;

class OrderController extends Controller
{
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

    public function show(string $id)
    {
        $order = Order::with('items', 'payment', 'latestStatus')->findOrFail($id);
        return response()->json($order);
    }

    public function edit(string $id)
    {
        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
    }


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

    public function getDriverPhone($orderId)
    {
        $order = Order::with('driver')->findOrFail($orderId);
        return response()->json(['phone' => $order->driver->phone]);
    }


    public function completeOrder($orderId)
    {
        $order = Order::findOrFail($orderId);
        $user = $order->user;
        $user->notify(new OrderRated($order));

        return response()->json([
            'message' => 'Order delivered, notification sent for rating.'
        ]);
    }

    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
    
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
