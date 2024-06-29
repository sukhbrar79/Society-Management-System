<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
*
* Frontend Routes
*
* --------------------------------------------------------------------
*/
Route::group(['namespace' => '\Modules\Parking\Http\Controllers\Frontend', 'as' => 'frontend.', 'middleware' => 'web', 'prefix' => ''], function () {

    /*
     *
     *  Frontend Parkings Routes
     *
     * ---------------------------------------------------------------------
     */
    $module_name = 'parkings';
    $controller_name = 'ParkingsController';
    Route::get("$module_name", ['as' => "$module_name.index", 'uses' => "$controller_name@index"]);
    Route::get("$module_name/{id}/{slug?}", ['as' => "$module_name.show", 'uses' => "$controller_name@show"]);
});

/*
*
* Backend Routes
*
* --------------------------------------------------------------------
*/
Route::group(['namespace' => '\Modules\Parking\Http\Controllers\Backend', 'as' => 'backend.', 'middleware' => ['web', 'auth', 'can:view_backend'], 'prefix' => 'admin'], function () {
    /*
    * These routes need view-backend permission
    * (good if you want to allow more than one group in the backend,
    * then limit the backend features by different roles or permissions)
    *
    * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
    */

    /*
     *
     *  Backend Parkings Routes
     *
     * ---------------------------------------------------------------------
     */
    $module_name = 'parkings';
    $controller_name = 'ParkingsController';
    Route::get("$module_name/index_list", ['as' => "$module_name.index_list", 'uses' => "$controller_name@index_list"]);
    Route::get("$module_name/index_data", ['as' => "$module_name.index_data", 'uses' => "$controller_name@index_data"]);
    Route::get("$module_name/trashed", ['as' => "$module_name.trashed", 'uses' => "$controller_name@trashed"]);
    Route::patch("$module_name/trashed/{id}", ['as' => "$module_name.restore", 'uses' => "$controller_name@restore"]);
    Route::resource("$module_name", "$controller_name");

    $parking_requests_module = 'parking_requests';
    $parking_requests_controller = 'ParkingRequestsController';
    Route::get("$parking_requests_module/index_list", ['as' => "$parking_requests_module.index_list", 'uses' => "$parking_requests_controller@index_list"]);
    Route::get("$parking_requests_module/index_data", ['as' => "$parking_requests_module.index_data", 'uses' => "$parking_requests_controller@index_data"]);
    Route::get("$parking_requests_module/trashed", ['as' => "$parking_requests_module.trashed", 'uses' => "$parking_requests_controller@trashed"]);
    Route::patch("$parking_requests_module/trashed/{id}", ['as' => "$parking_requests_module.restore", 'uses' => "$parking_requests_controller@restore"]);
    Route::resource("$parking_requests_module", "$parking_requests_controller");

});
