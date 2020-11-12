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

Route::namespace('Front')->group(function () {
    Route::get('formulario-libranza', 'libranzaController\LibranzaController@subForm');
    Route::get('thank-you-page', 'libranzaController\LibranzaController@thankYou')->name('thank.you.page');
    Route::get('benefits', 'benefitController\BenefitController@index')->name('benefit');
    Route::get('about-us', 'aboutController\AboutController@index')->name('about');
});
