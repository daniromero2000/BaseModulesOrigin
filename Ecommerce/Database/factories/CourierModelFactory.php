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

use Modules\Ecommerce\Entities\Couriers\Courier;

$factory->define(Courier::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->company,
        'description' => $faker->paragraph,
        'url' => $faker->url,
        'is_free' => 1,
        'is_active' => 1
    ];
});
