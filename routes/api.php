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
    // House
    Route::apiResource('/house-types', 'House\HouseTypesController', ['as' => 'admin']);
    // Customer
    Route::apiResource('/customer-types', 'Customer\CustomerTypesController', ['as' => 'admin']);
    // Rent
    Route::apiResource('/rent-types', 'Rent\RentTypesController', ['as' => 'admin']);
    // Location
    Route::group(['namespace' => 'Location'], function (){
        // Country
        Route::apiResource('/countries', 'CountriesController', ['as' => 'admin']);
        // Division
        Route::apiResource('/divisions', 'DivisionsController', ['as' => 'admin']);
        // City
        Route::apiResource('/cities', 'CitiesController', ['as' => 'admin']);
        // Police Station
        Route::apiResource('/police-stations', 'PoliceStationsController', ['as' => 'admin']);
        // Word
        Route::apiResource('/words', 'WordsController', ['as' => 'admin']);
        // Village
        Route::apiResource('/villages', 'VillagesController', ['as' => 'admin']);
    });
});

