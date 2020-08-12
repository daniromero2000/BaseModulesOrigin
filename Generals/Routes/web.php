<?php
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

use Illuminate\Support\Facades\Route;


/**
 * Admin routes
 */
Route::group(['prefix' => 'admin', 'middleware' => ['employee'], 'as' => 'admin.'], function () {
    Route::namespace('Admin')->group(function () {
        Route::namespace('Countries')->group(function () {
            Route::resource('countries', 'CountryController');
        });
        Route::resource('countries.provinces', 'Provinces\ProvinceController');
        Route::resource('countries.provinces.cities', 'Cities\CityController');
    });
});
