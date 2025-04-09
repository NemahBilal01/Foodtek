<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::all();
        return view('cartItems.index',compact('cartItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cartItems.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'food_item_id' => 'required|integer|exists:food_items,id',
            'quantity' => 'required|integer',
        ]);

        CartItem::create($request->all());

        return redirect()->route('cartItems.index')->with('success', 'Cart item created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cartItem = CartItem::findOrFail($id);
        return view('cartItems.show', compact('cartItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cartItem = CartItem::findOrFail($id);
        return view('cartItems.edit', compact('cartItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cartItem = CartItem::findOrFail($id);

        $request->validate([
            'user_id' => 'required|integer',
            'food_item_id' => 'required|integer|exists:food_items,id',
            'quantity' => 'required|integer',
        ]);

        $cartItem->update($request->all());

        return redirect()->route('cartItems.index')->with('success', 'Cart item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('cartItems.index')->with('success', 'Cart item deleted successfully');
    }
}
