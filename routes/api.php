<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('register', [AuthController::class, 'register']);
Route::post('verify-email', [AuthController::class, 'verifyEmail']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::prefix('customer')->group(function() {
        Route::post('create', [CustomerController::class, 'create']);
        Route::get('all', [CustomerController::class, 'allCustomers']);
        Route::get('', [CustomerController::class, 'index']);
        Route::post('{id}', [CustomerController::class, 'update']);
        Route::get('{id}', [CustomerController::class, 'show']);
        Route::delete('{id}', [CustomerController::class, 'destroy']);
    });


    
});