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
            Route::resource('courses', 'CoursesController');
        });

        Route::namespace('Students')->group(function () {
            Route::resource('students', 'StudentsController');
        });

        Route::namespace('CourseAttendances')->group(function () {
            Route::resource('course_attendances', 'CourseAttendancesController');
        });
    });
});

/**
 * Frontend routes
 */
Route::namespace('Front')->group(function () {

    Route::namespace('Courses')->group(function () {
        Route::get('/{course}', 'CoursesFrontController@show')->name('front.course');
    });

    Route::prefix('CourseAttendances')->group(function () {
        Route::get('course_attendances', 'CourseAttendancesFrontController@index');
    });
});
