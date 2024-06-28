<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1Controller;

// Customer API routes

Route::post('register', [V1Controller::class, 'register']);
Route::post('login', [V1Controller::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [V1Controller::class, 'logout']);
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
