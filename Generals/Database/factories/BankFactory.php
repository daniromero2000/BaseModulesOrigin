<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Modules\Generals\Entities\Banks\Bank;

$factory->define(Bank::class, function () {
    return [
        'name' => 'Citibank',
        'country_id' => 1,
        'is_active' => 1
    ];
});
