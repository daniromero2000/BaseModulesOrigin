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

use Faker\Generator as Faker;
use Modules\Generals\Entities\Currencies\Currency;


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Currency::class, function (Faker $faker, array $attributes) {

    return [
        'iso' => $faker->unique()->currencyCode,
        'name' => $faker->word,
    ];

});