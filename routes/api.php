<?php

use App\Http\Controllers\Api;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderItemController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\UserController;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\User;
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
Route::apiResource('user' , UserController::class);
Route::apiResource('addresses', AddressController::class);
Route::apiResource('cart-items', CartItemController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('delivery-statuses', DeliveryStatusesController::class);
Route::apiResource('delivery-tracking', DeliveryTrackingController::class);
Route::apiResource('food-items', FoodItemController::class);
Route::apiResource('restaurant', RestaurantController::class);
Route::apiResource('payment', PaymentController::class);
Route::apiResource('order', OrderController::class);
Route::apiResource('orderItem', OrderItemController::class);
Route::apiResource('notification', NotificationController::class);


//Route::post('addresses/{id}/restore', [AddressController::class, 'restore']);
