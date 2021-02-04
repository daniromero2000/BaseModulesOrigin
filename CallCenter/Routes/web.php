<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['employee'], 'as' => 'admin.'], function () {
    Route::namespace('Admin')->group(function () {
        Route::namespace('CampaignRequests')->group(function () {
            Route::resource('campaignRequests', 'CampaignRequestController');
        });

        Route::namespace('Campaigns')->group(function () {
            Route::resource('campaigns', 'CampaignController');
            Route::put('campaigns/import/{campaign}', 'CampaignController@import')->name('campaigns.import');
        });

        Route::namespace('Scripts')->group(function () {
            Route::resource('scripts', 'ScriptController');
        });

        Route::namespace('Questionnaires')->group(function () {
            Route::resource('questionnaires', 'QuestionnaireController');
            Route::get('getQuestionnaire/{id}', 'QuestionnaireController@findQuestionnaire');
        });
    });
});
