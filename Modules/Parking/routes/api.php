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
    Route::get('/parking', [ParkingController::class, 'index']);
    Route::get('/parking_slots', [ParkingController::class, 'parkingSlots']);
    Route::post('/parking', [ParkingController::class, 'store']);
    Route::put('/parking/{id}', [ParkingController::class, 'update']);
    Route::delete('/parking/{id}', [ParkingController::class, 'destroy']);
});

