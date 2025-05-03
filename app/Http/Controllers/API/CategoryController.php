<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //get all activated categories
    public function index()
    {
        $categories = Category::where('is_active' ,true)->get();
        return response()->json(['categories'=>$categories]);
    }


    /**
     * Store a newly created resource in storage.
     */
//     public function store(Request $request)
//     {
//         $validated = Validator::make($request->all(),[
//         'restaurant_id' => 'required|exists:restaurants,id',
//         'name' => 'required|string| max:255',
//         ]);

//         if($validated->fails()){
//             return response()->json($validated->errors(),400);
//         }
//         $category = Category::create([
//             'restaurant_id'=>$request->restaurant_id,
//             'name'=>$request->name,
//                     ]);

//         // $validated = $request->validate([
//         //     'restaurant_id' => 'required|exists: restaurants,id',
//         //     'name' => 'required|string| max:255',
//         // ]);
//         // $category = Category::create($validated);
//         return response()->json($category,201);
//     }

//     /**
//      * Display the specified resource.
//      */
    public function show(string $id)
    {
        $category = Category::with('foodItems')->findOrFail($id);//foodItems is the relationship method name in the model
        return response()->json($category);
    }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, string $id)
//     {
//         $category = Category::findOrFail($id);

//         $validated = Validator::make($request->all(),[
//             'restaurant_id' => 'required|exists:restaurants,id',
//             'name' => 'required|string| max:255',
//         ]);

//         if($validated->fails()){
//             return response()->json($validated->errors(),400);
//         }
//         // $validated = $request->validate([
//         //     'restaurant_id' => 'sometimes|exists: restaurants,id',
//         //     'name' => 'sometimes|string| max:255',
//         // ]);
//         // $category->update($validated);
//         $category->update([
//             'restaurant_id'=>$request->restaurant_id,
//             'name'=>$request->name,
//                     ]);
//         return response()->json($category);
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(string $id)
//     {
//         $category = Category::findOrFail($id);
//         $category->delete();
//         return response()->json(['message'=>'Category deleted successfully.'],200);
//     }
 }
