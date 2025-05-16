<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        return RestaurantResource::collection($restaurants);
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'owner_id' => 'required|numeric',
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'logo_url' => 'required|max:255',
            'opening_time' => 'required|max:255',
            'closing_time' => 'required|max:255',
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 400);
        }

        $restaurant = Restaurant::create($validated->validated());

        return (new RestaurantResource($restaurant))
                ->response()
                ->setStatusCode(201);
    }

    public function show(Restaurant $restaurant)
    {
        return new RestaurantResource($restaurant);
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        $validated = Validator::make($request->all(), [
            'owner_id' => 'required|numeric',
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'logo_url' => 'required|max:255',
            'opening_time' => 'required|max:255',
            'closing_time' => 'required|max:255',
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 400);
        }

        $restaurant->update($validated->validated());

        return new RestaurantResource($restaurant);
    }

    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}
