<?php

namespace Modules\Generals\Database\factories;

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

use Illuminate\Database\Eloquent\Factory;
use Modules\Generals\Entities\Genres\Genre;

$factory->define(Genre::class, function () {
    return [
        'genre'   => 'Masculino',
    ];
});
