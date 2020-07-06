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

use Modules\Companies\Entities\Subsidiaries\Subsidiary;
use Modules\Generals\Entities\Cities\City;

$factory->define(Subsidiary::class, function (Faker\Generator $faker) {
    $name = $faker->randomElement([
        'La 19',
    ]);

    return [
        'name'          => $name,
        'address'       => str_slug($name),
        'phone'         => 3183643,
        'opening_hours' => '8: 00 a 12: 00',
        'city_id'       => 1,
        'company_id'       => 1
    ];
});
