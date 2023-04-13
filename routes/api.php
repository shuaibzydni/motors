<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post("/buyers/login", [
    \App\Http\Controllers\Buyers\AuthController::class,
    "login",
]);
Route::post("/buyers/social-login", [
    \App\Http\Controllers\Buyers\AuthController::class,
    "socialLogin",
]);
Route::post("/buyers/forgot-password", [
    \App\Http\Controllers\Buyers\AuthController::class,
    "forgotPassword",
]);
Route::post("/buyers/verify-password", [
    \App\Http\Controllers\Buyers\AuthController::class,
    "verifyPassword",
]);
Route::post("/buyers/register", [
    \App\Http\Controllers\Buyers\AuthController::class,
    "register",
]);
Route::post("/sellers/login", [
    \App\Http\Controllers\Sellers\AuthController::class,
    "login",
]);
Route::post("/sellers/social-login", [
    \App\Http\Controllers\Sellers\AuthController::class,
    "socialLogin",
]);
Route::post("/sellers/forgot-password", [
    \App\Http\Controllers\Sellers\AuthController::class,
    "forgotPassword",
]);
Route::post("/sellers/verify-password", [
    \App\Http\Controllers\Sellers\AuthController::class,
    "verifyPassword",
]);
Route::post("/sellers/register", [
    \App\Http\Controllers\Sellers\AuthController::class,
    "register",
]);

Route::get("common/locations", [
    \App\Http\Controllers\Common\LocationController::class,
    "locations",
]);

Route::post("/buyers/create-payment-intent", [
    \App\Http\Controllers\CheckoutController::class,
    "checkout",
]);
Route::post("/sellers/create-payment-intent", [
    \App\Http\Controllers\CheckoutController::class,
    "checkout",
]);