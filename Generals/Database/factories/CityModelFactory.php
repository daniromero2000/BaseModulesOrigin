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

use Modules\Generals\Entities\Cities\City;

$factory->define(City::class, function () {
    return [
        'dane'            => 001,
        'city'            => 'Pereira',
        'province_id'     => 1,
        'is_active_leads' => 0
    ];
});
