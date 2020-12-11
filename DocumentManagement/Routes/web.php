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
        Route::group([], function () {
            Route::namespace('Document')->group(function () {
                Route::resource('documents', 'DocumentController');
            });
            Route::namespace('DocumentCategories')->group(function () {
                Route::resource('document-categories', 'DocumentCategoryController');
            });
        });
    });
});
