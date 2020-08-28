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

use Modules\Companies\Entities\Employees\Employee;

$factory->define(Employee::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'                 => $faker->firstName,
        'last_name'            => $faker->lastName,
        'email'                => $faker->unique()->safeEmail,
        'subsidiary_id'        => 1,
        'employee_position_id' => 1,
        'password'             => $password ?: $password = bcrypt('secret'),
        'remember_token'       => str_random(10),
        'rh'                   => 'O-',
        'bank_account'       => str_random(10),
    ];
});
