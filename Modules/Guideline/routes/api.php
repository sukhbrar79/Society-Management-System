<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Guideline\Http\Controllers\API\GuidelinesController;
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
    Route::get('/guidelines', [GuidelinesController::class, 'index']);
    Route::post('/guidelines', [GuidelinesController::class, 'store']);
    Route::put('/guidelines/{id}', [GuidelinesController::class, 'update']);
    Route::delete('/guidelines/{id}', [GuidelinesController::class, 'destroy']);
});