<?php

use App\Http\Controllers\API\FavoriteController;
use App\Http\Controllers\API\HistoryController;
use App\Http\Controllers\API\RatingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\CartItemController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\FoodItemController;
use App\Http\Controllers\API\ClientTrackOrderController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\PaymentMethodController;
use App\Http\Controllers\API\RestaurantController;
use App\Http\Controllers\API\ChatController;
use App\Http\Controllers\API\ItemRatingController ;
use App\Http\Controllers\API\SpecialOfferController;

// Auth routes
Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('logout', 'logout')->middleware('auth:sanctum');
    Route::post('reset-password', [AuthController::class, 'resetPasswordWithToken']);
    Route::post('forgot-password', 'sendResetToken');
    Route::get('reset-password/{token}', 'verifyResetPasswordToken');
    
});

// Social Auth
Route::controller(SocialAuthController::class)->group(function () {
    Route::post('/login/google/token', 'loginWithGmailToken');
    Route::post('/login/facebook/token', 'loginWithFacebookToken');
    Route::post('/login/apple', 'loginWithAppleToken');
});

// Routes requiring authentication
Route::middleware('auth:sanctum')->group(function () {
    Route::put('/user/profile', [UserController::class, 'updateProfile']);
});

// User Routes
Route::apiResource('user', UserController::class)->only(['index', 'show', 'update']); //show and update

// Cart Items
Route::prefix('cart-items')->controller(CartItemController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('{cart_item}', 'show');
    Route::put('{cart_item}', 'update');
    Route::delete('{cart_item}', 'destroy');
    // Route::get('/increment/{id}', 'updateQuantity');
    // Route::get('/decrement/{id}', 'updateQuantity');
});

// Orders & history
Route::apiResource('order', OrderController::class)->only(['index', 'store', 'show']);
Route::get('get_user_orders/{user_id}' , [HistoryController::class , 'getUserOrders']);
// Track Order Route
Route::get('/client/track-order/{order_id}', [ClientTrackOrderController::class, 'trackOrder']);

// Categories & Food Items
Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
Route::apiResource('food-items', FoodItemController::class)->only(['index', 'show']);
Route::get('top-recommended', [FoodItemController::class, 'recommended']);
Route::get('food-under-category/{id}', [FoodItemController::class, 'FoodUnderCategory']);

// Notifications
// Route::apiResource('notification/{id}', NotificationController::class)->only(['index', 'show']);
Route::post('notification/{id}',[NotificationController::class,'index']);
Route::post('notification',[NotificationController::class,'store']);
Route::post('notifications/{id}/markAsRead', [NotificationController::class, 'markAsRead']);

// Payment
Route::apiResource('payment', PaymentController::class)->only(['index', 'store']);
Route::get('payment_method/user/{id}', [PaymentMethodController::class, 'index']);
Route::post('payment_method', [PaymentMethodController::class, 'store']);

// Restaurant
Route::apiResource('restaurant', RestaurantController::class)->only(['index', 'show']);

// Chat
Route::middleware('auth:sanctum')->post('/chat/{orderId}', [ChatController::class, 'store']);
Route::middleware('auth:sanctum')->post('/chat/archive/{orderId}', [ChatController::class, 'archiveChat']);

// Ratings
Route::post('/rate-order', [RatingController::class, 'store']);
Route::post('/ratings', [RatingController::class, 'store']);
Route::get('/rating',[ItemRatingController::class , 'index']);

// Special Offers (if applicable for the mobile app)
Route::get('/special-offers', [SpecialOfferController::class, 'index']);

//favorite list
Route::get('/favorites/{id}' ,[FavoriteController::class , 'index']);
Route::post('/favorites' ,[FavoriteController::class , 'store']);
Route::delete('/favorites/{id}' ,[FavoriteController::class , 'destroy']);

