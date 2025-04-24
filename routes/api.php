<?php

use App\Http\Controllers\Api;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderItemController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\SocialAuthController;
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
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\api\SpecialOfferController;
use App\Models\SpecialOffer;

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
Route::apiResource('specialOffer',SpecialOfferController::class);
Route::apiResource('rating',RatingController::class);
//auth routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('reset-password', [AuthController::class, 'resetPassword']);

// Route with Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Route::get('/user', function (Request $request) {
    //     return $request->user();
    // });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/user/profile', [UserController::class, 'updateProfile']);
});

//Route::post('addresses/{id}/restore', [AddressController::class, 'restore']);


//login with gmail
Route::post('/login/google/token', [SocialAuthController::class, 'loginWithGmailToken']);
//login with facebook
Route::post('/login/facebook/token', [SocialAuthController::class, 'loginWithFacebookToken']);
