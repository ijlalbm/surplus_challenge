<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/category', App\Http\Controllers\Api\CategoryController::class);
Route::apiResource('/product', App\Http\Controllers\Api\ProductController::class);
Route::apiResource('/image', App\Http\Controllers\Api\ImageController::class);
Route::apiResource('/categoryProduct', App\Http\Controllers\Api\CategoryProductController::class);
Route::apiResource('/productImage', App\Http\Controllers\Api\ProductImageController::class);
