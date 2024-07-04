<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Block\Http\Controllers\API\BlockController;

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
    Route::get('/blocks', [BlockController::class, 'index']);
});
