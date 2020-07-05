<?php

namespace Modules\Generals\Database\Seeders;

use Modules\Generals\Entities\Genres\Genre;
use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    public function run()
    {
        factory(genre::class)->create([
            'genre'  => 'Hombre',
        ]);

        factory(Genre::class)->create([
            'genre'  => 'Mujer',
        ]);

        factory(Genre::class)->create([
            'genre'  => 'Otro',
        ]);
    }
}
