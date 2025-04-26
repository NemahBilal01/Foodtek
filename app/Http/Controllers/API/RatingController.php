<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FoodItem;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    // return top 10 rated
    public function index(){
    // $topFoods = FoodItem::with(['ratings' => function ($query) {
    //     $query->orderBy('rate', 'desc')->limit(1);
    // }])
    // ->take(10)
    // ->get();

    $topFoods = FoodItem::withAvg('ratings', 'rate')
    ->orderByDesc('ratings_avg_rate')
    ->take(10)
    ->get();

    // $topFoods = DB::table('food_items')
    // ->join('ratings','food_items.id' , '=' , 'ratings.food_item_id')
    // ->select('food_items.*' ,'food_items.id','ratings.food_item_id', DB::raw('AVG(rate) as rating'))
    // ->groupBy('food_item_id')
    // ->orderBy('rating' , 'desc')->take('10')->get();
    //->join('special_offer' , 'food_items.id' , '=' , 'special_offer.food_item_id')

    return response()->json(['topFood'=>$topFoods]);
    }

    public function store(Request $request){

        $validated = Validator::make($request->all(), [
            'food_item_id'=>'required|numeric',
            'user_id'=>'required|numeric',
            'rate'=>'required|numeric',
            'review'=>'required|max:225',
        ]);

    if($validated->fails()){
        return response()->json($validated->errors(),400);
    }


    $rating = Rating::create([
        'food_item_id'=>$request->food_item_id,
        'user_id'=>$request->user_id,
        'rate'=>$request->rate,
        'review'=>$request->review,
    ]);
    return response()->json(   $rating,201);
    }
}
