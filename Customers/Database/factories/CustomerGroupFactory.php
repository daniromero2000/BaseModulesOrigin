<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Modules\Customers\Entities\CustomerGroups\CustomerGroup;

$factory->define(CustomerGroup::class, function (Faker $faker) {
    $name = ucfirst($faker->word);

    return [
        'name'            => $name,
        'is_user_defined' => $faker->boolean,
        'code'            => lcfirst($name),
    ];
});
