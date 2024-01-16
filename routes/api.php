<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SaleController;



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

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::group(['middleware' => 'api'], function () {
        Route::get('/logout', [AuthController::class, 'logout']);
        Route::get('/refresh', [AuthController::class, 'refresh']);
        Route::get('/me', [AuthController::class, 'me']);
    });
});


Route::group(['prefix' => 'status'], function () {
    Route::get('/', [StatusController::class, 'index']);
    Route::post('/store', [StatusController::class, 'store']);
    Route::get('/show/{id}', [StatusController::class, 'show']);
    Route::put('/update/{id}', [StatusController::class, 'update']);
    Route::delete('/destroy/{id}', [StatusController::class, 'destroy']);
});

Route::group(['prefix' => 'bus'], function () {
    Route::get('/', [BusController::class, 'index']);
    Route::post('/store', [BusController::class, 'store']);
    Route::get('/show/{id}', [BusController::class, 'show']);
    Route::put('/update/{id}', [BusController::class, 'update']);
    Route::delete('/destroy/{id}', [BusController::class, 'destroy']);
});


Route::group(['prefix' => 'client'], function () {
    Route::get('/', [ClientController::class, 'index']);
    Route::post('/store', [ClientController::class, 'store']);
    Route::get('/show/{id}', [ClientController::class, 'show']);
    Route::put('/update', [ClientController::class, 'update']);
    Route::delete('/destroy/{id}', [ClientController::class, 'destroy']);
});


Route::group(['prefix' => 'supplier'], function () {
    Route::get('/{user}', [SupplierController::class, 'index']);
    Route::post('/{user}', [SupplierController::class, 'store']);
    Route::get('/show/{id}', [SupplierController::class, 'show']);
    Route::put('/', [SupplierController::class, 'update']);
    Route::delete('/{id}', [SupplierController::class, 'delete']);
});

Route::group(['prefix' => 'product-category'], function () {
    Route::get('/{user}', [ProductCategoryController::class, 'index']);
    Route::post('/{user}', [ProductCategoryController::class, 'store']);
    Route::get('/show/{id}', [ProductCategoryController::class, 'show']);
    Route::put('/{user}', [ProductCategoryController::class, 'update']);
    Route::delete('/{id}', [ProductCategoryController::class, 'delete']);
});

Route::group(['prefix' => 'product'], function () {
    Route::get('/statuses', [ProductController::class, 'statuses']);
    Route::get('/{user}', [ProductController::class, 'index']);
    Route::post('/{user}', [ProductController::class, 'store']);
    Route::get('/show/{id}', [ProductController::class, 'show']);
    Route::put('/{user}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'delete']);
});

Route::group(['prefix' => 'customer'], function () {
    Route::get('/statuses', [CustomerController::class, 'statuses']);
    Route::get('/{user}', [CustomerController::class, 'index']);
    Route::post('/{user}', [CustomerController::class, 'store']);
    Route::get('/show/{id}', [CustomerController::class, 'show']);
    Route::put('/{user}', [CustomerController::class, 'update']);
    Route::delete('/{id}', [CustomerController::class, 'delete']);
});

Route::group(['prefix' => 'sale'], function () {
    Route::get('/statuses', [SaleController::class, 'statuses']);
    Route::get('/getSaleCreationData/{user}', [SaleController::class, 'getSaleCreationData']);
    Route::get('/{user}', [SaleController::class, 'index']);
    Route::post('/{user}', [SaleController::class, 'store']);
    Route::get('/show/{id}', [SaleController::class, 'show']);
    Route::put('/{user}', [SaleController::class, 'update']);
    Route::delete('/{id}', [SaleController::class, 'delete']);
});
