<?php

use Illuminate\Support\Facades\Route;

Route::get('/detail', [\App\Http\Controllers\Sellers\AuthController::class, 'authUser']);
Route::post('/change-password', [\App\Http\Controllers\Sellers\AuthController::class, 'changePassword']);
Route::put('/edit-details', [\App\Http\Controllers\Sellers\SellerController::class, 'editAccountDetails']);
Route::post('/update-avatar', [\App\Http\Controllers\Sellers\SellerController::class, 'updateAvatar']);
Route::post('/logout', [\App\Http\Controllers\Sellers\AuthController::class, 'logout']);

Route::get('car-models', [\App\Http\Controllers\Common\ProductMakeController::class, 'list']);
Route::get('body-types', [\App\Http\Controllers\Common\BodyTypeController::class, 'list']);
Route::get('drive-types', [\App\Http\Controllers\Common\DriveTypeController::class, 'list']);
Route::get('fuel-types', [\App\Http\Controllers\Common\FuelTypeController::class, 'list']);
Route::get('make', [\App\Http\Controllers\Common\ProductBrandController::class, 'list']);
Route::get('categories', [\App\Http\Controllers\Common\ProductCategoryController::class, 'list']);
Route::get('transmissions', [\App\Http\Controllers\Common\TransmissionController::class, 'list']);
Route::get('model-years', [\App\Http\Controllers\Common\ModelYearController::class, 'list']);

Route::get('cars/list', [\App\Http\Controllers\Sellers\ProductController::class, 'list']);
Route::post('cars/add', [\App\Http\Controllers\Sellers\ProductController::class, 'store']);
Route::put('cars/update/{productId}', [\App\Http\Controllers\Sellers\ProductController::class, 'update']);
Route::get('cars/show/{productId}', [\App\Http\Controllers\Sellers\ProductController::class, 'show']);
Route::delete('cars/delete/{productId}', [\App\Http\Controllers\Sellers\ProductController::class, 'delete']);

Route::get('subscription-plans', [\App\Http\Controllers\Sellers\SubscriptionPlanController::class, 'list']);
Route::post('subscription-create/{plan}', [\App\Http\Controllers\Sellers\SubscriptionPlanController::class, 'subscriptionCreate']);

Route::post('/bid/accept/{id}', [\App\Http\Controllers\ApiBiddingController::class, 'acceptBid']);
Route::post('/bid/sold/{id}', [\App\Http\Controllers\ApiBiddingController::class, 'soldBid']);

Route::get('notification/list/{limit?}', [\App\Http\Controllers\NotificationController::class, 'apiNotificationList']);
Route::post('notification/mark-as-read/{notification}', [\App\Http\Controllers\NotificationController::class, 'apiMarkAsRead']);
Route::post('notification/mark-all-as-read', [\App\Http\Controllers\NotificationController::class, 'apiMarkAllAsRead']);
Route::post('notification/update-device', [\App\Http\Controllers\NotificationController::class, 'apiUpdateFcmDevice']);
