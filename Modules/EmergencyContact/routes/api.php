<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\EmergencyContact\Http\Controllers\API\EmergencyContactsController;
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
    Route::get('/emergencyDetails', [EmergencyContactsController::class, 'index']);
    Route::post('/emergencyDetails', [EmergencyContactsController::class, 'store']);
    Route::put('/emergencyDetails/{id}', [EmergencyContactsController::class, 'update']);
    Route::delete('/emergencyDetails/{id}', [EmergencyContactsController::class, 'destroy']);
});
