<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\SpecialOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CartItemResource;

class CartItemController extends Controller
{
    public function index()
    {
        return CartItemResource::collection(CartItem::with('foodItem')->get());
    }

    public function cartItem()
    {
        return CartItemResource::collection(CartItem::with(['user', 'foodItem'])->get());
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'food_item_id'=> 'required|exists:food_items,id',
            'quantity'=> 'required|integer|min:1',
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 400);
        }

        $cartItem = CartItem::create($request->only('user_id', 'food_item_id', 'quantity'));

        return new CartItemResource($cartItem->load('foodItem'));
    }

    public function show(string $user_id)
    {
        $cartItems = CartItem::with('foodItem')
            ->where('user_id', $user_id)
            ->get();

        return CartItemResource::collection($cartItems);
    }

    public function updateQuantity(Request $request, string $id)
    {
        $cartItem = CartItem::findOrFail($id);

        $validated = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'food_item_id'=> 'required|exists:food_items,id',
            'quantity'=> 'required|integer|min:1',
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 400);
        }

        $cartItem->update($request->only('user_id', 'food_item_id', 'quantity'));

        return new CartItemResource($cartItem->load('foodItem'));
    }

    public function getCartSummary(Request $request, string $userId)
    {
        $cartItems = CartItem::with('foodItem')->where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Cart is empty']);
        }

        $distanceKm = $request->input('distance_km');
        $deliveryCharge = 0.50 + (0.13 * $distanceKm);
        $totalDiscount = 0;
        $subtotal = 0;

        foreach ($cartItems as $item) {
            $itemPrice = $item->foodItem->price;
            $itemTotal = $itemPrice * $item->quantity;
            $subtotal += $itemTotal;

            $offer = SpecialOffer::where('food_item_id', $item->food_item_id)->first();

            if ($offer) {
                $itemDiscount = $itemTotal * ($offer->discount_percentage / 100);
                $totalDiscount += $itemDiscount;
            }
        }

        $total = ($subtotal + $deliveryCharge) - $totalDiscount;

        return response()->json([
            'subtotal' => round($subtotal, 2),
            'delivery_charge' => round($deliveryCharge, 2),
            'discount' => round($totalDiscount, 2),
            'total_price' => round($total, 2)
        ]);
    }

    public function destroy(string $id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        return response()->json(['message' => 'Cart item deleted successfully.']);
    }

    public function QuantityIncrement(string $id)
    {
        DB::table('cart_items')->where('id', $id)->increment('quantity');
        return response()->json(['message' => 'Quantity incremented.']);
    }

    public function QuantityDecrement(string $id)
    {
        DB::table('cart_items')->where('id', $id)->decrement('quantity');
        return response()->json(['message' => 'Quantity decremented.']);
    }
}

