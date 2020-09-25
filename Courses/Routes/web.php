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
        Route::namespace('Courses')->group(function () {
            Route::resource('Courses', 'CoursesController');
        });

        Route::namespace('Students')->group(function () {
            Route::resource('students', 'StudentsController');
        });
    });
});

/**
 * Frontend routes
 */
Route::prefix('courses')->group(function () {
    Route::get('/', 'CoursesFrontController@index');
});
