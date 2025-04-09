<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeliveryStatusesController;
use App\Http\Controllers\DeliveryTrackingController;
use App\Http\Controllers\FoodItemController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::resource('restaurants', RestaurantController::class);
Route::resource('users', UserController::class);
Route::resource('addresses', AddressController::class);
Route::resource('cartItems', CartItemController::class);
Route::resource('categories', CategoryController::class);
Route::resource('deliveryStatuses', DeliveryStatusesController::class);
Route::resource('deliveryTracking', DeliveryTrackingController::class);
Route::resource('foodItems', FoodItemController::class);
Route::resource('notifications', NotificationController::class);
Route::resource('orders', OrderController::class);
Route::resource('orderItems', OrderItemController::class);
Route::resource('payments', PaymentController::class);


Route::get('/', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store'])->name('users.store');


/*
Route::get('/', function () {
    return view('welcome');
});
*/
