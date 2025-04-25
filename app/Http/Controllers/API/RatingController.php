<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    // return top 10 rated
    public function index(){
        return Rating::orderBy('rate' ,'desc')->take(10)->get();
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
