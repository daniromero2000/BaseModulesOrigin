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
    Route::get('formulario-libranza', 'libranzaController\LibranzaController@subForm')->name('form-libranza');
    Route::get('thank-you-page', 'libranzaController\LibranzaController@thankYou')->name('thank.you.page');
    Route::get('benefits', 'benefitController\BenefitController@index')->name('benefit');
    Route::get('about-us', 'aboutController\AboutController@index')->name('about');
    Route::get('/codigo-etica', function () {
        return view('libranza.front.information.code_of_ethics');
    })->name('code.ethics');
    Route::get('/politica-tratamiento-de-datos', function () {
        return view('libranza.front.information.data_treatment_policy');
    })->name('data.treatment.policy');
    Route::get('/quienes-somos', function () {
        return view('libranza.front.information.about_us');
    })->name('about.us');
    Route::get('/proteccion-de-datos-personales', function () {
        return view('libranza.front.information.data_treatment_policy');
    })->name('data.treatment');
    Route::get('/terminos-y-condiciones', function () {
        return view('libranza.front.information.terms_and_conditions');
    })->name('terms.and.conditions');
    Route::get('/por-que-comprar-con-nosotros', function () {
        return view('libranza.front.information.buy_with_us');
    })->name('buy.with.us');
    Route::get('/cambios-devoluciones-y-atencion-de-garantias', function () {
        return view('libranza.front.information.returns_changes');
    })->name('returns.changes');
    Route::get('/preguntas-frecuentes', function () {
        return view('libranza.front.information.frequent_questions');
    })->name('frequent.questions');
});
