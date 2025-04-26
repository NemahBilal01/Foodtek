<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\FoodItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        $foodItem = FoodItem::create([
            'restaurant_id'=>$request->restaurant_id,
            'category_id'=>$request->category_id,
            'name'=>$request->name,
            'description'=>$request->description,
            'price'=>$request->price,
            'image_path'=>$request->image_path,
            'is_available'=>$request->is_available,
                    ]);
        // $validated = $request->validate([
            // 'restaurant_id' => 'required|exists:restaurants,id',
            // 'category_id' =>'required|exists:categories,id',
            // 'name'=>'required|string|max:100',
            // 'description'=>'nullable|string|max:255',
            // 'price' => 'required|numeric|min:0',
            // 'image_path'=>'nullable|string',
            // 'is_available'=>'required|boolean',

        // ]);
        // $foodItem = FoodItem::create($validated);
        return response()->json($foodItem,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $foodItem = FoodItem::with('specialOffers','ratings')->findOrFail($id);
        $foodItem = DB::table('food_items')
        ->join('ratings' , 'food_items.id' , '='  , 'ratings.food_item_id')
        ->join('special_offers' , 'food_items.id' ,'=' , 'special_offers.food_item_id')
        ->select('food_items.image_path', 'food_items.name_en','food_items.Description_en','food_items.price' ,'ratings.review',
        DB::raw('AVG(ratings.rate) as rating'),
        DB::raw('food_items.price - (food_items.price * special_offers.discount_percentage / 100) as price_after_discount')
        )
        ->where('food_items.id' , '=',$id)
        ->where('food_items.is_available' , '=',true)
        ->groupBy('food_items.id',
        'food_items.image_path',
        'food_items.name_en',
        'food_items.Description_en',
        'food_items.price',
        'special_offers.discount_percentage',
        'ratings.review')->get();

        return response()->json($foodItem);
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
        $foodItem->update([
            'restaurant_id'=>$request->restaurant_id,
            'category_id'=>$request->category_id,
            'name'=>$request->name,
            'description'=>$request->description,
            'price'=>$request->price,
            'image_path'=>$request->image_path,
            'is_available'=>$request->is_available,
                    ]);

        // $validated = $request->validate([
        //     'restaurant_id' => 'sometimes|exists:restaurants,id',
        //     'category_id' =>'sometimes|exists:categories,id',
        //     'name'=>'sometimes|string|max:100',
        //     'description'=>'nullable|string|max:255',
        //     'price' => 'sometimes|numeric|min:0',
        //     'image_path'=>'nullable|string',
        //     'is_available'=>'sometimes|boolean',
        // ]);
        // $foodItem->update($validated);
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
    // get top 10 recommended food

    public function recommended(){
        // get the top food item id
        $TopFoodId = CartItem::select('food_item_id' , DB::raw('COUNT(*) as total'))
        ->groupBy('food_item_id')->orderBy('total' , 'desc')
        ->limit(10)->pluck('food_item_id');

        // get food item data from there id's
        $TopRecommended = FoodItem::whereIn('id' , $TopFoodId)->get();
        return response()->json(['TopRecommended' => $TopRecommended]);
    }

    //get food item under category
    public function FoodUnderCategory(string $id){
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        if($category->is_active === false){
            return response()->json(['message' => 'Category is not active'], 404);
        }

        $foodItem = FoodItem::where('category_id', $category->id)->get();
        return  response()->json(['foodItem' => $foodItem]);
    }
}
