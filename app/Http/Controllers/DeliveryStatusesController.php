<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DeliveryStatus;
use Illuminate\Http\Request;

class DeliveryStatusesController extends Controller
{
    public function index()
    {
        $deliveryStatuses = DeliveryStatus::all();
        // dd($deliveryStatuses);
        return view('deliveryStatuses.index',compact('deliveryStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('deliveryStatuses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
            'status' => 'required|string|max:255',
        ]);

        DeliveryStatus::create([
            'order_id' => $request->order_id,
            'status' => $request->status,
        ]);
        return redirect()->route('deliveryStatuses.index')->with('success', 'Delivery status created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $deliveryStatus = DeliveryStatus::findOrFail($id);
        return view('deliveryStatuses.edit', compact('deliveryStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $deliveryStatus = DeliveryStatus::find($id);
    
        if (!$deliveryStatus) {
            return redirect()->route('deliveryStatuses.index')->with('error', 'Delivery status not found');
        }
        $request->validate([
            'order_id' => 'required|integer',
            'status' => 'required|string|max:255',
        ]);
    
        $deliveryStatus->update([
            'order_id' => $request->order_id,
            'status' => $request->status,
        ]);
    
        return redirect()->route('deliveryStatuses.index')->with('success', 'Delivery status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deliveryStatus = DeliveryStatus::findOrFail($id);
        $deliveryStatus->delete();
    
        return redirect()->route('deliveryStatuses.index')->with('success', 'Delivery status deleted successfully');
    }
}
