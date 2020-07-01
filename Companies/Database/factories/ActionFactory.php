<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Companies\Entities\Actions\Action;

$factory->define(Action::class, function (Faker\Generator $faker) {
    return [
        'permission_id' => 1,
        'name'          => $faker->word,
        'icon'          => $faker->word,
        'route'         => $faker->unique()->word,
        'principal'     => 1
    ];
});
