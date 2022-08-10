<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MechanicController;
use App\Http\Controllers\ProfileInformationController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\TransactionListResource;
use App\Http\Resources\TransactionResource;
use App\Models\Product;
use App\Models\Transaction;

Route::middleware('auth:sanctum')->group(function () {
});
Route::get('profile/{user:username}', ProfileInformationController::class);
Route::get('me', AuthUserController::class);
// Route::apiResource('customer', CustomerController::class);
// Route::post('status', [QueueController::class, 'setStatus']);
// Route::apiResource('queue', QueueController::class);
Route::apiResource('service', ServiceController::class);
// Route::apiResource('vehicle', VehicleController::class);
// Route::apiResource('mechanic', MechanicController::class);
Route::get('admin', [AdminController::class, 'index']);
Route::post('login', [AuthController::class, 'login']);
Route::apiResource('transaction', TransactionController::class);
Route::apiResource('products', ProductController::class);
Route::get('kaostory', [AdminController::class, 'kaostory']);
