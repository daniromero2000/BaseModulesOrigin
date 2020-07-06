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

use Modules\Companies\Entities\DepartmentsEmployees\DepartmentEmployee;
use Modules\Companies\Entities\Departments\Department;
use Modules\Companies\Entities\Employees\Employee;

$factory->define(DepartmentEmployee::class, function () {

    return [
        'department_id' => 1,
        'employee_id' =>  1
    ];
});
