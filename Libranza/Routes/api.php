<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'leads'], function () {
    Route::namespace('Api')->group(function () {
        Route::namespace('libranzaController')->group(function () {
            Route::group(['middleware' => 'auth:api'], function () {
                Route::post('register', 'LibranzaController@store');
            });
        });
    });
});

Route::group(['prefix' => 'leads/test'], function () {
    Route::namespace('Api')->group(function () {
        Route::namespace('libranzaController')->group(function () {
            Route::group(['middleware' => 'auth:api'], function () {
                Route::post('register', 'LibranzaController@testStore');
            });
        });
    });
});
