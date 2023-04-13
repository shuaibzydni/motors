<?php

use Illuminate\Support\Facades\Route;

Route::get('car-models', [\App\Http\Controllers\Common\ProductMakeController::class, 'list']);
Route::get('body-types', [\App\Http\Controllers\Common\BodyTypeController::class, 'list']);
Route::get('drive-types', [\App\Http\Controllers\Common\DriveTypeController::class, 'list']);
Route::get('fuel-types', [\App\Http\Controllers\Common\FuelTypeController::class, 'list']);
Route::get('make', [\App\Http\Controllers\Common\ProductBrandController::class, 'list']);
Route::get('categories', [\App\Http\Controllers\Common\ProductCategoryController::class, 'list']);
Route::get('transmissions', [\App\Http\Controllers\Common\TransmissionController::class, 'list']);
Route::get('model-years', [\App\Http\Controllers\Common\ModelYearController::class, 'list']);

Route::get('car-list', [\App\Http\Controllers\Buyers\CarController::class, 'apiCarList']);
Route::get('car-show/{id}', [\App\Http\Controllers\Buyers\CarController::class, 'apiCarShow']);