<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Visitor\Http\Controllers\API\VisitorController;

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
    Route::get('/visitors', [VisitorController::class, 'index']);
    Route::post('/visitors', [VisitorController::class, 'store']);
    Route::put('/visitors/{id}', [VisitorController::class, 'update']);
    Route::delete('/visitors/{id}', [VisitorController::class, 'destroy']);
});
