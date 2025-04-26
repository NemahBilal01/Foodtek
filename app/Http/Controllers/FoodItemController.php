<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Restaurant;
use App\Models\FoodItem;
use Illuminate\Http\Request;

class FoodItemController extends Controller
{
    public function index()
    {
        $foodItems = FoodItem::with(['restaurant', 'category'])->get();
        return view('foodItems.index', compact('foodItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $restaurants = Restaurant::all();
        $categories = Category::all();

        return view('foodItems.create', compact('restaurants', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image_path' => 'nullable|string',
            'is_available' => 'required|boolean',
        ]);

        FoodItem::create($request->all());

        return redirect()->route('foodItems.index')->with('success', 'Food item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $foodItem = FoodItem::findOrFail($id);

        return view('foodItems.show', compact('foodItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $foodItem = FoodItem::with(['restaurant', 'category'])->findOrFail($id);
        $restaurants = Restaurant::all();
        $categories = Category::all();

        return view('foodItems.edit', compact('foodItem', 'restaurants', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'restaurant_id' => 'required|exists:restaurants,id',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image_path' => 'nullable|string',
            'is_available' => 'required|boolean',
        ]);

        $foodItem = FoodItem::findOrFail($id);
        $foodItem->update([
            'name' => $request->name,
            'restaurant_id' => $request->restaurant_id,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price,
            'image_path' => $request->image_path,
            'is_available' => $request->is_available,
        ]);

        return redirect()->route('foodItems.index')->with('success', 'Food Item updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $foodItem = FoodItem::findOrFail($id);
        $foodItem->delete();

        return redirect()->route('foodItems.index')->with('success', 'Food item deleted successfully.');
    }
}
