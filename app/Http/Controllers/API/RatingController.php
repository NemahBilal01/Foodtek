<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Rating;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'order_rating' => 'nullable|integer|min:1|max:5',
            'delivery_rating' => 'nullable|integer|min:1|max:5',
            'feedback' => 'nullable|string',
        ]);

        $rating = Rating::create([
            'order_id' => $validated['order_id'],
            'user_id' => Auth::id(), // Assuming the client is authenticated
            'delivery_man_id' => $request->delivery_man_id,
            'order_rating' => $validated['order_rating'],
            'delivery_rating' => $validated['delivery_rating'],
            'feedback' => $validated['feedback'],
        ]);

        return response()->json([
            'message' => 'Your rating has been submitted successfully!',
            'rating' => $rating,
        ]);
    }
}
