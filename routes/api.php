<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\PaymentController;



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
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/restaurants', [RestaurantController::class, 'index']);
Route::get('/restaurants/filter', [RestaurantController::class, 'filterByCategory']);
Route::get('/restaurants/{id}', [RestaurantController::class, 'show']);
Route::get('/get-client-token', [PaymentController::class, 'getClientToken']);
Route::post('/process-payment', [PaymentController::class, 'processPayment']);







