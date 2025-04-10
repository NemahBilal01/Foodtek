<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return CartItem::all();
        return CartItem::with(['user', 'foodItem'])->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'user_id' => 'required|exists:users,id',
            'food_item_id'=> 'required|exists:food_items,id',
            'quantity'=> 'required|integer|min:1',
        ]);

        if($validated->fails()){
            return response()->json($validated->errors(),400);
        }

        // $validated = $request ->validate([
        //     'user_id' => 'required|exists:users,id',
        //     'food_item_id'=> 'required|exists:food_items,id',
        //     'quantity'=> 'required|integer|min:1',
        // ]);

        $cartItem = CartItem::create([
            'user_id'=>$request->user_id,
            'food_item_id'=>$request->food_item_id,
            'quantity'=>$request->quantity,
                    ]);
        // $cartItem = CartItem::create($validated);
        return response()->json($cartItem,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cartItem = CartItem::findOrFail($id);
        //$cartItem = CartItem::with(['user', 'foodItem'])->findOrFail($id);
        return response()->json($cartItem);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cartItem = CartItem::findOrFail($id);
        $validated = Validator::make($request->all(),[
            'user_id' => 'required|exists:users,id',
            'food_item_id'=> 'required|exists:food_items,id',
            'quantity'=> 'required|integer|min:1',
        ]);

        if($validated->fails()){
            return response()->json($validated->errors(),400);
        }
            $cartItem->update([
            'user_id'=>$request->user_id,
            'food_item_id'=>$request->food_item_id,
            'quantity'=>$request->quantity,
                        ]);

        // $validated = $request ->validate([
        //     'user_id' => 'sometimes | exists : users,id',
        //     'food_item_id'=> 'sometimes|exists:food_items,id',
        //     'quantity'=> 'sometimes|integer|min:1',
        // ]);
        // $cartItem->update($validated);
        return response()->json($cartItem);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();
        return response()->json(['message' => 'cart item deleted successfully.'], 200);
    }
}
