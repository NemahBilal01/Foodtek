<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CartItem::all();
        
    }

    public function cartItem(){
        //return all te he food item in cart item for a specific user
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
    //get the cart item of specific user
    public function show(string $user_id)
    {
    //     $cartItem = CartItem::with('foodItem')
    //     ->where('user_id','=',$id)->get();
        $cartItem = DB::table('food_items')
        ->join('cart_items', 'food_items.id' , '=' , 'cart_items.food_item_id')
        ->select('food_items.id','food_items.image_path' , 'food_items.name_en' , 'food_items.price' , 'cart_items.quantity')
        ->where('cart_items.user_id' ,'=' ,$user_id)
        ->get();

        return response()->json($cartItem);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateQuantity(Request $request, string $id)
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
        return response()->json(['message'=> 'add one to quantity']);

    }

    public function getCartSummary(Request $request , string $userId)
{


    // get all food item from cart 
    $cartItems = CartItem::with('foodItem')->where('user_id', $userId)->get();

    if ($cartItems->isEmpty()) {
        return response()->json(['message' => 'Cart is empty']);
    }

    // //  calculate Subtotal
    // $subtotal = 0;

    // foreach ($cartItems as $item) {
    //     $subtotal += $item->foodItem->price * $item->quantity;
    // }

    // // calculate Delivery Charge
    // $distanceKm = $request->input('distance_km'); //
    // $deliveryCharge = 0.50 + (0.13 * $distanceKm);

    // // calculate discount if there .
    // $discount = 0;

    
    // if ($request->has('discount_percentage')) {
    //     $discount = ($subtotal + $deliveryCharge) * ($request->discount_percentage / 100);
    // }

    // // 5. المجموع النهائي
    // $total = ($subtotal + $deliveryCharge) - $discount;

    // return response()->json([
    //     'subtotal' => round($subtotal, 2),
    //     'delivery_charge' => round($deliveryCharge, 2),
    //     'discount' => round($discount, 2),
    //     'total_price' => round($total, 2)
    // ]);
}


    /**
     * remove food item from cart item for user
     */
    public function destroy(string $id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();
        return response()->json(['message' => 'cart item deleted successfully.'], 200);
    }

    //method to increment quantity to one
    public function QuantityIncrement(string $id){
        // id to cart item
        DB::table('cart_items')->where('id', $id)->increment('quantity');
        return response()->json(['message'=> 'add one to quantity']);
    }

    //method to decrement quantity by one
    public function QuantityDecrement(string $id){
        DB::table('cart_items')->where('id', $id)->decrement('quantity');
        return response()->json(['message'=> 'decrement quantity']);
    }
}
