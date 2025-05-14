<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/**
 * Public routes
 * Prefix: /auth
 */
Route::prefix('/auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/google/redirect', [AuthController::class, 'redirect']);
    Route::get('/google/callback', [AuthController::class, 'callback']);
});

/**
 * Private routes
 * Middleware: auth:sanctum
 */
Route::group(['middleware' => 'auth:sanctum'], function () {
    /** Logout route */
    Route::post('/logout', [AuthController::class, 'logout']);

    /** Business routes */
    Route::resource('/businesses', App\Http\Controllers\BusinessController::class);

    /** Feedback routes */
    Route::resource('/feedbacks', App\Http\Controllers\FeedbackController::class);
});
