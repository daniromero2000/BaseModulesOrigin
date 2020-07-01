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

use Modules\Generals\Entities\Countries\Country;

$factory->define(Country::class, function (Faker\Generator $faker) {

    return [
        'name'      => $faker->unique()->country,
        'iso'       => $faker->unique()->countryISOAlpha3,
        'iso3'      => $faker->unique()->countryISOAlpha3,
        'numcode'   => $faker->randomDigit,
        'phonecode' => $faker->randomDigit,
        'is_active'    => 1
    ];
});
