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



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::apiResource('user' , UserController::class);


Route::apiResources([
    'user'=> UserController::class,
    'restaurant'=>RestaurantController::class,
    'payment'=>PaymentController::class,
    'order'=>OrderController::class,
    'orderItem'=>OrderItemController::class,
    'notification'=>NotificationController::class,
]);
