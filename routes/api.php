<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1Controller;

// Customer API routes

Route::post('register', [V1Controller::class, 'register']);
Route::post('login', [V1Controller::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [V1Controller::class, 'logout']);
    Route::get('/profile', [V1Controller::class, 'profileShow']);
    Route::get('/emergencyDetails', [V1Controller::class, 'emergencyDetails']);
    Route::put('/profile', [V1Controller::class, 'profileUpdate']);
    Route::get('/notifications/list', [V1Controller::class, 'list']);
    Route::post('/notifications/read/{notification}', [V1Controller::class, 'markAsRead']);
    
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
