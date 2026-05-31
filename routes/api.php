<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\ClientApiController;
use App\Http\Controllers\Api\PropertyApiController;
use App\Http\Controllers\Api\TransactionApiController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthApiController::class, 'register'])->middleware('guest');
Route::post('/login', [AuthApiController::class, 'login'])->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthApiController::class, 'logout']);
    Route::get('/me', [AuthApiController::class, 'me']);

    Route::apiResource('properties', PropertyApiController::class);
    Route::apiResource('clients', ClientApiController::class);
    Route::apiResource('transactions', TransactionApiController::class);
    Route::get('/reports', [TransactionApiController::class, 'report']);
});
