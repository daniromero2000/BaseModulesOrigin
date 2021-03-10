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
        Route::namespace('Customers')->group(function () {
            Route::resource('customers', 'CustomerController');
            Route::resource('customer-statuses', 'CustomerStatusController');
            Route::get('customers/{customer}/recover', 'CustomerController@recoverTrashedCustomer')->name('customers.recover');
            Route::get('/api/customers', 'CustomerController@list');
            Route::get('/api/customers/{id}', 'CustomerController@getCustomer');
            Route::get('/api/listEconomicActivity', 'CustomerController@getlistEconomicActivity');
            Route::get('/api/listCities', 'CustomerController@getListCities');
            Route::get('/api/listRelationships', 'CustomerController@getRelationships');
            Route::get('/api/listCivilStatuses', 'CustomerController@getCivilStatuses');
            Route::get('/api/listGenres', 'CustomerController@getGenres');
            Route::get('/api/listScholarities', 'CustomerController@getScholarities');
            Route::get('/api/listProfessions', 'CustomerController@getProfessions');
            Route::get('/api/listVehicles', 'CustomerController@getVehicles');
            Route::get('/api/listIdentityTypes', 'CustomerController@getIdentityTypes');
            Route::get('/api/listHousings', 'CustomerController@getHousings');
            Route::get('/api/listStratums', 'CustomerController@getStratums');
            Route::get('/api/listEps', 'CustomerController@getEps');
        });
        Route::namespace('CustomerAddresses')->group(function () {
            Route::resource('customer-addresses', 'CustomerAddressController');
        });

        Route::namespace('CustomerIdentities')->group(function () {
            Route::resource('customer-identities', 'CustomerIdentityController');
        });

        // Route::namespace('CustomerPhones')->group(function () {
        //     Route::resource('customer-phones', 'CustomerPhoneController');
        // });

        Route::namespace('CustomerEpss')->group(function () {
            Route::resource('customer-epss', 'CustomerEpsController');
        });

        Route::namespace('CustomerReferences')->group(function () {
            Route::resource('customer-references', 'CustomerReferenceController');
        });

        Route::namespace('CustomerEconomicActivities')->group(function () {
            Route::resource('customer-economic-activities', 'CustomerEconomicActivityController');
        });

        Route::namespace('CustomerProfessions')->group(function () {
            Route::resource('customer-professions', 'CustomerProfessionController');
        });

        Route::namespace('CustomerVehicles')->group(function () {
            Route::resource('customer-vehicles', 'CustomerVehicleController');
        });

        Route::namespace('CustomerEmails')->group(function () {
            Route::resource('customer-emails', 'CustomerEmailController');
        });

        Route::namespace('CustomerCommentaries')->group(function () {
            Route::resource('customer-commentaries', 'CustomerCommentaryController');
        });

        Route::namespace('NewsletterSubscriptions')->group(function () {
            Route::resource('newsletter-subscription', 'NewsletterSubscriptionController');
        });
    });
});


/**
 * Frontend routes
 */
Route::namespace('Front')->group(function () {
    Route::namespace('NewsletterSubscriptions')->group(function () {
        Route::resource('newsletter-subscription', 'NewsletterSubscriptionFrontController');
    });
});
