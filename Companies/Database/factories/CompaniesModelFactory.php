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

use Modules\Companies\Entities\Companies\Company;

$factory->define(Company::class, function () {
    return [
        'name'          => 'FVN',
        'city_id'         => 1,
        'base_currency_id' => 3
    ];
});
