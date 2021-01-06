<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['employee'], 'as' => 'admin.'], function () {
    Route::namespace('Admin')->group(function () {
        Route::namespace('CampaignRequests')->group(function () {
            Route::resource('campaignRequests', 'CampaignRequestController');
        });
    });
});
