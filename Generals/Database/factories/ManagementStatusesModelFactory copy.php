<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Generals\Entities\ManagementStatuses\ManagementStatus;

$factory->define(ManagementStatus::class, function () {
    return [
        'status' => 'Asesoría Inadecuada',
        'type_management_status' => '0'
    ];
});
