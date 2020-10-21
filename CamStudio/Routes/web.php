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
        Route::namespace('Cammodels')->group(function () {
            Route::resource('cammodels', 'CammodelsController');
            Route::get('remove-thumb', 'CammodelsController@removeThumbnail')->name('cammodels.remove.thumb');
            Route::get('cammodels/cammodel/profile', 'CammodelsController@getProfile')->name('cammodels.profile');
        });
        Route::namespace('CammodelCategories')->group(function () {
            Route::resource('cammodel-categories', 'CammodelCategoriesController');
            Route::put('api/update-cammodel-categories-order/{id}', 'CammodelCategoriesController@updateSortOrder');
            Route::get('remove-image-cammodel-categories', 'CammodelCategoriesController@removeImage')->name('cammodel-categories.remove.image');
        });
        Route::namespace('CammodelBannedCountries')->group(function () {
            Route::resource('banned-countries', 'CammodelBannedCountryController');
        });
    });
});

/**
 * Frontend routes
 */
Route::namespace('Front')->group(function () {
    Route::group(['middleware' => ['auth', 'web']], function () {
    });
});
