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

use Modules\Companies\Entities\Departments\Department;
use Modules\Companies\Entities\Subsidiaries\Subsidiary;

$factory->define(Department::class, function () {

    $subsidiary = factory(Subsidiary::class)->create();

    return [
        'name'          => 'Gestión Humana',
        'phone'         => 3183643,
        'subsidiary_id' => $subsidiary->id
    ];
});
