<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoodItemResource;
use App\Http\Resources\RatingResource;
use App\Models\FoodItem;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemRatingController extends Controller
{
    public function index()
    {
        $topFoods = FoodItem::where('is_available', true)
            ->withAvg('ratings', 'rate')
            ->orderByDesc('ratings_avg_rate')
            ->take(10)
            ->get();

        return FoodItemResource::collection($topFoods);
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'food_item_id' => 'required|exists:food_items,id',
            'user_id' => 'required|exists:users,id',
            'rate' => 'required|numeric|min:1|max:5',
            'review' => 'required|string|max:225',
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 400);
        }

        $rating = Rating::create($validated->validated());

        return new RatingResource($rating);
    }
}
