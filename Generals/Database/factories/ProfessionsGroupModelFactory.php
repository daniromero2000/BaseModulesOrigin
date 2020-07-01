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

use Modules\Generals\Entities\ProfessionsGroups\ProfessionsGroup;

$factory->define(ProfessionsGroup::class, function () {
    return [
        'ciuo'   => '1218',
        'professions_group'   => 'Ingenieros',
    ];
});
