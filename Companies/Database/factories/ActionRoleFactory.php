<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Companies\Entities\ActionRole\ActionRole;

$factory->define(ActionRole::class, function (Faker\Generator $fakerr) {
    return [
        'action_id' => 1,
        'role_id'   => 1
    ];
});
