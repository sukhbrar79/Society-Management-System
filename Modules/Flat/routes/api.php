<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Flat\Http\Controllers\API\FlatsController;
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
    Route::get('/flats', [FlatsController::class, 'index']);
    Route::get('/get-flats-by-block', [FlatController::class, 'getFlatsByBlock']);
});
