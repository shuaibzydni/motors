<?php

use Illuminate\Support\Facades\Route;

Route::get('/detail', [\App\Http\Controllers\Buyers\AuthController::class, 'authUser']);
Route::post('/change-password', [\App\Http\Controllers\Buyers\AuthController::class, 'changePassword']);
Route::put('/edit-details', [\App\Http\Controllers\Buyers\BuyerController::class, 'editAccountDetails']);
Route::post('/update-avatar', [\App\Http\Controllers\Buyers\BuyerController::class, 'updateAvatar']);
Route::post('/logout', [\App\Http\Controllers\Buyers\AuthController::class, 'logout']);

Route::get('favourites', [\App\Http\Controllers\Common\FavouriteController::class, 'apiFavourites']);
Route::post('favourites/{productId}', [\App\Http\Controllers\Common\FavouriteController::class, 'apiUpdateFavourite']);

Route::post('/bid/add/{id}', [\App\Http\Controllers\ApiBiddingController::class, 'requestBid']);
Route::post('/bid/update/{id}', [\App\Http\Controllers\ApiBiddingController::class, 'updateBid']);
Route::delete('/bid/delete/{id}', [\App\Http\Controllers\ApiBiddingController::class, 'deleteBid']);

Route::get('biddings', [\App\Http\Controllers\ApiBiddingController::class, 'biddings']);

Route::get('subscription-plans', [\App\Http\Controllers\Buyers\SubscriptionPlanController::class, 'list']);
Route::post('subscription-create/{plan}', [\App\Http\Controllers\Buyers\SubscriptionPlanController::class, 'subscriptionCreate']);

Route::get('notification/list/{limit?}', [\App\Http\Controllers\NotificationController::class, 'apiNotificationList']);
Route::post('notification/mark-as-read/{notification}', [\App\Http\Controllers\NotificationController::class, 'apiMarkAsRead']);
Route::post('notification/mark-all-as-read', [\App\Http\Controllers\NotificationController::class, 'apiMarkAllAsRead']);
Route::post('notification/update-device', [\App\Http\Controllers\NotificationController::class, 'apiUpdateFcmDevice']);
