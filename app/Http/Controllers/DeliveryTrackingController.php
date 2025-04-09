<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DeliveryTracking;
use Illuminate\Http\Request;

class DeliveryTrackingController extends Controller
{
    public function index()
    {
        $deliveryTracking = DeliveryTracking::all();
        return view('deliveryTracking.index', compact('deliveryTracking'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('deliveryTracking.create');
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

        DeliveryTracking::create($request->all());

        return redirect()->route('deliveryTracking.index')->with('success', 'Delivery Tracking created successfully.');
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
        $deliveryTrack = DeliveryTracking::findOrFail($id);
        return view('deliveryTracking.edit', compact('deliveryTrack'));
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

        return redirect()->route('deliveryTracking.index')->with('success', 'Delivery Tracking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deliveryTrack = DeliveryTracking::findOrFail($id);
        $deliveryTrack->delete();

        return redirect()->route('deliveryTracking.index')->with('success', 'Delivery Tracking deleted successfully.');
    }
}
