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
    Route::namespace('libranzaController')->group(function () {
        Route::resource('libranza', 'LibranzaController');
        Route::get('formulario-libranza', 'LibranzaController@subForm')->name('form-libranza');
        Route::get('formulario-credito-libranza', 'LibranzaController@creditForm')->name('form-credit-libranza');
        Route::get('thank-you-page', 'LibranzaController@thankYou')->name('thank.you.page');
    });
    Route::namespace('benefitController')->group(function () {
        Route::get('benefits', 'BenefitController@index')->name('benefit');
    });
    Route::namespace('aboutController')->group(function () {
        Route::get('about-us', 'AboutController@index')->name('about');
    });

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

Route::group(['prefix' => 'admin', 'middleware' => ['employee'], 'as' => 'admin.'], function () {
    Route::namespace('Admin')->group(function () {
        Route::namespace('Covenants')->group(function () {
            Route::resource('convenios', 'CovenantController');
        });
    });
});
