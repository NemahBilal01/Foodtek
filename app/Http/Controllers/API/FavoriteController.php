<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavoriteResource;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FavoriteController extends Controller
{
    // Show all the user's favorites
    public function index(string $id)
    {
        $favorites = Favorite::where('user_id', $id)->get();
        return FavoriteResource::collection($favorites);
    }

    // Store a new favorite
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'food_item_id' => 'required|exists:food_items,id',
        ]);

        if ($validated->fails()) {
            return response()->json(['error' => $validated->errors()], 422);
        }

        $favorite = Favorite::create($request->only(['user_id', 'food_item_id']));

        return (new FavoriteResource($favorite))
            ->additional(['message' => 'Favorite added successfully']);
    }

    // Remove a favorite
    public function destroy(string $id)
    {
        $favorite = Favorite::findOrFail($id);
        $favorite->delete();

        return response()->json(['message' => 'Favorite removed successfully']);
    }
}
