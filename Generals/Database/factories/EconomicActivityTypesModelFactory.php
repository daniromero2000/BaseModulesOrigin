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

use Modules\Generals\Entities\EconomicActivityTypes\EconomicActivityType;

$factory->define(EconomicActivityType::class, function (Faker\Generator $faker) {

    return [
        'economic_activity_type'  => $faker->word,
    ];
});
