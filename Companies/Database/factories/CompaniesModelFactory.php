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
        'name' => 'Lagobo',
        'country_id' => 1,
        'currency_id' => 3,
        'identification' => 123456,
        'company_type' => 'Administrativo',
    ];
});
