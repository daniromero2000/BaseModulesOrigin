<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Companies\Entities\EmployeePositions\EmployeePosition;

$factory->define(EmployeePosition::class, function () {
    return [
        'position' => 'Coordinador'
    ];
});
