<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\FoodItem;
use Illuminate\Http\Request;

class FoodItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return FoodItem::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'category_id' =>'required|exists:categories,id',
            'name'=>'required|string|max:100',
            'description'=>'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'image_path'=>'nullable|string',
            'is_available'=>'required|boolean',

        ]);
        $foodItem = FoodItem::create($validated);
        return response()->json($foodItem,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $foodItem = FoodItem::findOrFail($id);
        return response()->json($foodItem);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $foodItem = FoodItem::findOrFail($id);

        $validated = $request->validate([
            'restaurant_id' => 'sometimes|exists:restaurants,id',
            'category_id' =>'sometimes|exists:categories,id',
            'name'=>'sometimes|string|max:100',
            'description'=>'nullable|string|max:255',
            'price' => 'sometimes|numeric|min:0',
            'image_path'=>'nullable|string',
            'is_available'=>'sometimes|boolean',
        ]);
        $foodItem->update($validated);
        return response()->json($foodItem);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $foodItem = FoodItem::findOrFail($id);
        $foodItem->delete();
        return response()->json(['message' => 'Food Item deleted successfully.'], 200);
    }
}
