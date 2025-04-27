<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FavoriteController extends Controller
{
   //show all the user favorites 
    public function show(string $id){

        $favorites =  Favorite::where('user_id','=',$id)->get();
        return response()->json(['favorites'=>$favorites]);
    }

    //store a new favorite
    public function store(Request $request){

        $validated = Validator::make($request->all() , [
            'user_id'=>'required|exists:users,id',
            'food_item_id'=>'required|exists:food_items,id',
        ]);
        if($validated->fails()){
            return response()->json(['error'=>$validated->errors()] , 402);
        }

        $favorite = Favorite::create([
            'user_id'=>$request->user_id,
            'food_item_id' => $request->food_item_id, 
           ]);

        return response()->json(['message'=>'favorite added successfully' ,'favorite'=>$favorite]);
    }

    public function destroy(Favorite $favorite){

        $favorite->delete();
        return response()->json(['message'=>'favorite remove successfully']);
    }
}
