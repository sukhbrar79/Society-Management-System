<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Invoice\Http\Controllers\API\InvoiceController;
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
    Route::get('/invoice', [InvoiceController::class, 'index']);
    Route::post('/invoice', [InvoiceController::class, 'store']);
    Route::put('/invoice/{id}', [InvoiceController::class, 'update']);
    Route::delete('/invoice/{id}', [InvoiceController::class, 'destroy']);
});
