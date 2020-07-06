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

use Modules\Generals\Entities\ProfessionsLists\ProfessionsList;


$factory->define(ProfessionsList::class, function (Faker\Generator $faker) {


    return [
        'ciuo'       => 1545,
        'profession' => 'Ingeniero',
    ];
});
