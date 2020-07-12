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

use Modules\Ecommerce\Entities\AttributeValues\AttributeValue;


$factory->define(AttributeValue::class, function (Faker\Generator $faker) {
    return [
        'value' => $faker->unique()->word,
        'sort_order' => 1
    ];
});
