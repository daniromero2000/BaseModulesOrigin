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

use Modules\Ecommerce\Entities\Brands\Brand;

$factory->define(Brand::class, function (Faker\Generator $faker) {


    $brand = $faker->company;
    return [
        'name' => 'FVN',
        'slug' => str_slug($brand),
    ];
});
