<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Parking\Http\Controllers\API\ParkingController;

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


Route::middleware('auth:api')->group(function () {
    Route::get('/parking', [ParkingsController::class, 'index']);
    Route::post('/parking', [ParkingsController::class, 'store']);
    Route::put('/parking/{id}', [ParkingsController::class, 'update']);
    Route::delete('/parking/{id}', [ParkingsController::class, 'destroy']);
});

