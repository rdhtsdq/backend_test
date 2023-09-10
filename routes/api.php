<?php

use App\Http\Controllers\FlashSaleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/products", [ProductsController::class, 'getProducts']);
Route::post("/product", [ProductsController::class, 'addProduct']);
Route::get("/flash", [FlashSaleController::class, 'getProducts']);
Route::post("/order", [OrderController::class, 'Order']);
