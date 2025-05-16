<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    // Get all active categories
    public function index()
    {
        $categories = Category::where('is_active', true)->get();
        return CategoryResource::collection($categories);
    }

    // Store a new category
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'restaurant_id' => 'required|exists:restaurants,id',
            'name' => 'required|string|max:255',
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 400);
        }

        $category = Category::create($request->only('restaurant_id', 'name'));

        return new CategoryResource($category);
    }

    // Show category with its food items
    public function show(string $id)
    {
        $category = Category::with('foodItems')->findOrFail($id);
        return new CategoryResource($category);
    }

    // Update an existing category
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $validated = Validator::make($request->all(), [
            'restaurant_id' => 'required|exists:restaurants,id',
            'name' => 'required|string|max:255',
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 400);
        }

        $category->update($request->only('restaurant_id', 'name'));

        return new CategoryResource($category);
    }

    // Delete a category
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully.']);
    }
}

