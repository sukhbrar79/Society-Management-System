<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Complaint\Http\Controllers\API\ComplaintsController;
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
    Route::get('/complaints', [ComplaintsController::class, 'index']);
    Route::post('/complaints', [ComplaintsController::class, 'store']);
    Route::put('/complaints/{id}', [ComplaintsController::class, 'update']);
    Route::delete('/complaints/{id}', [ComplaintsController::class, 'destroy']);
});
