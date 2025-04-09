<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\API\CartItemController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\DeliveryStatusesController;
use App\Http\Controllers\API\DeliveryTrackingController;
use App\Http\Controllers\API\FoodItemController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//Route::apiResource('users' , UserController::class);
Route::apiResource('addresses', AddressController::class);
Route::apiResource('cart-items', CartItemController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('delivery-statuses', DeliveryStatusesController::class);
Route::apiResource('delivery-tracking', DeliveryTrackingController::class);
Route::apiResource('food-items', FoodItemController::class);


//Route::post('addresses/{id}/restore', [AddressController::class, 'restore']);
