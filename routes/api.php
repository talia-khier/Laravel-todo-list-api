<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::prefix('user')->middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [UserController::class, 'show']);
});

Route::fallback(function () {
    return response()->json([
        'status' => 'error',
        'message' => 'Endpoint not found.',
    ], 404);
});
