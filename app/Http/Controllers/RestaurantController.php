<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('restaurants.index',compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     * creation of a new restaurant
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'owner_id' => 'required|exists:users,id',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'logo_url' => 'nullable|string|max:255',
            'opening_time' => 'nullable|date_format:H:i',
            'closing_time' => 'nullable|date_format:H:i',
            'is_active' => 'required|boolean',
        ]);
    
        $restaurant = Restaurant::create($validated);
    
        return redirect()->route('restaurants.index')->with('success', 'Restaurant created successfully!');
    }

    /**
     * Display the specified resource.
     * display the details of a specific restaurant
     */
    public function show(string $id)
    {
        $restaurant = Restaurant::with('categories', 'foodItems')->findOrFail($id);
        return response()->json($restaurant);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $restaurant = Restaurant::findOrFail($id);

        return view('restaurants.edit', compact('restaurant'));
    }

    /**
     * Update the specified resource in storage.
     * update a restaurant's details, such as its name or opening hours
     */
    public function update(Request $request, string $id)
    {
        $restaurant = Restaurant::findOrFail($id);
    
        $validated = $request->validate([
            'owner_id' => 'sometimes|exists:users,id',
            'name' => 'sometimes|string|max:100',
            'description' => 'nullable|string|max:255',
            'logo_url' => 'nullable|string|max:255',
            'opening_time' => 'nullable|date_format:H:i',
            'closing_time' => 'nullable|date_format:H:i',
            'is_active' => 'sometimes|boolean',
        ]);
    
        $restaurant->update($validated);
    
        return response()->json($restaurant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();
        return redirect()->route('restaurants.index')->with('success', 'Restaurant deleted successfully.');
    }
}
