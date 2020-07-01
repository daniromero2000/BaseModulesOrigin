<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Generals\Entities\Epss\Eps;
use Faker\Generator as Faker;

$factory->define(Eps::class, function () {
    return [
        'eps' => 'Sura'
    ];
});
