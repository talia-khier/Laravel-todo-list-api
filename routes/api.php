<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::post('/user/register', [AuthController::class, 'register']);
Route::post('/user/login', [AuthController::class, 'login']);

Route::fallback(function () {
    return response()->json([
        'status' => 'error',
        'message' => 'Endpoint not found.'
    ], 404);
});
