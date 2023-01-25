<?php

use App\Http\Controllers\ProductController;
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

// Rutas para la api de productos
Route::controller(ProductController::class)->prefix('product')->group(function () {
    Route::get('/categories', 'getAllCategories')->name('categories');
    Route::get('/stock-qty/{product_id}', 'getProductStockQty')->name('stock.qty');
    Route::get('/trendings','getTrendings')->name('trendings');
    Route::get('/store','storeProducts')->name('store');
    Route::post('/update-stocks-qty', 'updateProductsStocks')->name('update.stocks.qty');
});

Route::apiResource('product', 'App\Http\Controllers\ProductController');
