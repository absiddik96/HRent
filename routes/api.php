<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'Api\V1\Auth\AuthController@login')->name('api.auth.login');

Route::group(['prefix' => 'admin', 'namespace' => 'Api\V1\Admin', 'as' => 'api.'], function () {
    // Admin
    Route::apiResource('/admin', 'AdminController', ['as' => 'admin']);
    Route::apiResource('/house-types', 'House\HouseTypesController', ['as' => 'admin']);
});

