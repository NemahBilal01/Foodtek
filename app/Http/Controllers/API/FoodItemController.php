<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\FoodItem;
use App\Models\itemRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\FoodItemResource;


class FoodItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return FoodItemResource::collection(FoodItem::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = Validator::make($request->all(),[
            'restaurant_id' => 'required|exists:restaurants,id',
            'category_id' =>'required|exists:categories,id',
            'name'=>'required|string|max:100',
            'description'=>'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'image_path'=>'nullable|string',
            'is_available'=>'required|boolean',
        ]);

        if($validated->fails()){
            return response()->json(['errors' => $validated->errors()], 400);
        }
        $foodItem = FoodItem::create($request->only([
        'restaurant_id', 'category_id', 'name', 'description', 'price', 'image_path', 'is_available'
       ]));

        return (new FoodItemResource($foodItem))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $food_id)
    {
        $foodItem = FoodItem::find($food_id);

        if(!$foodItem){
            return response()->json(['message'=>'food item not found'], 404);
        }

        $specialOffer  = $foodItem->specialOffer;

        $price_after_discount = $specialOffer ? $foodItem->price - ( $foodItem->price * $specialOffer->discount_percentage / 100) : null;

        $rateAvg = round(ItemRating::where('food_item_id', $food_id)->avg('rate') ?? 0, 1);

        $numberOfReview = ItemRating::where('food_item_id', $food_id)->count('review');

        return response()->json([
            'food_item'=>new FoodItemResource($foodItem),
            'price_after_discount'=> $price_after_discount ,
            'rating'=>$rateAvg,
            'number_of_review'=>$numberOfReview
        ]);

        // return new FoodItemResource($foodItem);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $foodItem = FoodItem::findOrFail($id);

        $validated = Validator::make($request->all(),[
            'restaurant_id' => 'required|exists:restaurants,id',
            'category_id' =>'required|exists:categories,id',
            'name'=>'required|string|max:100',
            'description'=>'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'image_path'=>'nullable|string',
            'is_available'=>'required|boolean',
        ]);

        if($validated->fails()){
            return response()->json($validated->errors(),400);
        }
        $foodItem->update($request->only([
            'restaurant_id', 'category_id', 'name', 'description', 'price', 'image_path', 'is_available'
        ]));
        return new FoodItemResource($foodItem);
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


    public function recommended(){
        $TopFoodId = CartItem::select('food_item_id' , DB::raw('COUNT(*) as total'))
        ->groupBy('food_item_id')
        ->orderByDesc('total')
        ->limit(10)
        ->pluck('food_item_id');

        $TopRecommended = FoodItem::whereIn('id' , $TopFoodId)->get();

        return FoodItemResource::collection($TopRecommended);
    }

    public function FoodUnderCategory(string $id){
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        if($category->is_active === false){
            return response()->json(['message' => 'Category is not active'], 403);
        }

        $foodItem = FoodItem::where('category_id', $id)->get();
        return  FoodItemResource::collection($foodItem);
    }
}
