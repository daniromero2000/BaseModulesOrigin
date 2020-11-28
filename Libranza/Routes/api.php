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

Route::namespace('Front')->group(function () {
    Route::namespace('libranzaController')->group(function () {
        Route::post('formulario-credito-libranza', 'LibranzaController@storeProduct')->name('api-form-credit-libranza');
    });
});