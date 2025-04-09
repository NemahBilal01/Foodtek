<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Restaurant::all();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'owner_id'=>'required|numeric',
            'name'=>'required|max:255',
            'description'=>'required|max:255',
            'logo_url'=>'required|max:255',
            'opening_time'=>'required|max:255',
            'closing_time'=>'required|max:255',
        ]);

        if($validated->fails()){
            return response()->json($validated->errors(),400);
        }

            $restaurant = Restaurant::create([
                'owner_id'=>$request->owner_id,
                'name'=>$request->name,
                'description'=>$request->description,
                'logo_url'=>$request->logo_url,
                'opening_time'=>$request->opening_time,
                'closing_time'=>$request->closing_time,
                        ]);

             return response()->json($restaurant , 201);
        }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        return response()->json($restaurant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Restaurant $restaurant )
    {

        $validated = Validator::make($request->all(),[
            'owner_id'=>'required|numeric',
            'name'=>'required|max:255',
            'description'=>'required|max:255',
            'logo_url'=>'required|max:255',
            'opening_time'=>'required|max:255',
            'closing_time'=>'required|max:255',
        ]);

        if($validated->fails()){
            return response()->json($validated->errors(),400);
        }
            $restaurant->update([
                'owner_id'=>$request->owner_id,
                'name'=>$request->name,
                'description'=>$request->description,
                'logo_url'=>$request->logo_url,
                'opening_time'=>$request->opening_time,
                'closing_time'=>$request->closing_time,
                        ]);

                return response()->json($restaurant);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return response()->json(['message'=>'deleted successfully'] ,200);
    }
}
