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

use Modules\Companies\Entities\EmployeePhones\EmployeePhone;
use Modules\Companies\Entities\Employees\Employee;

$factory->define(EmployeePhone::class, function (Faker\Generator $faker) {

    $employee = factory(Employee::class)->create();

    return [
        'phone_type'  => 'Fijo',
        'phone'       => '0',
        'employee_id' => $employee->id,
        'status'      => 1
    ];
});
