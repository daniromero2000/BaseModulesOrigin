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

    Route::namespace('Pqrs')->group(function () {
        Route::resource('pqrs', 'PqrController');
        Route::resource('pqr-statuses', 'PqrStatusController');
        Route::get('pqrsdashboard', 'PqrsDashboardController@index')->name('pqrsdashboard');
        Route::get('pqrs/{pqr}/recover', 'PqrController@recoverTrashedPqr')->name('pqrs.recover');
    });
    Route::resource('pqrCommentaries', 'PqrCommentaries\PqrCommentaryController');
});


/**
 * Frontend routes
 */
Route::namespace('Front')->group(function () {
    Route::group(['prefix' => 'front'], function () {
        Route::namespace('Pqrs')->group(function () {
            Route::resource('pqrs', 'PqrController');
        });
    });
});

Route::namespace('Front')->group(function () {
    // Route::get('/', 'HomeController@index')->name('home');
    Route::namespace('Pqrs')->group(function () {
    });
});
