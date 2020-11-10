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

Route::group(['prefix' => 'admin', 'middleware' => ['employee'], 'as' => 'admin.'], function () {
    Route::namespace('Admin')->group(function () {
        Route::resource('leads', 'LeadsController');
        Route::post('leads-store-comments', 'LeadsController@comments')->name('leads.store.comments');
        Route::get('getDeparment/{id}', 'LeadsController@searchDepartment');
    });
});


Route::namespace('Front')->group(function () {
    Route::resource('leads', 'LeadController');
});
