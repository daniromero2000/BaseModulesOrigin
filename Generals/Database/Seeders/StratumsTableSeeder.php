<?php

namespace Modules\Generals\Database\Seeders;

use Modules\Generals\Entities\Stratums\Stratum;
use Illuminate\Database\Seeder;

class StratumsTableSeeder extends Seeder
{
    public function run()
    {
        factory(Stratum::class)->create([
            'stratum'  => '1',
            'description'  => 'Estrato 1',
        ]);

        factory(Stratum::class)->create([
            'stratum'  => '2',
            'description'  => 'Estrato 2',
        ]);

        factory(Stratum::class)->create([
            'stratum'  => '3',
            'description'  => 'Estrato 3',
        ]);

        factory(Stratum::class)->create([
            'stratum'  => '4',
            'description'  => 'Estrato 4',
        ]);

        factory(Stratum::class)->create([
            'stratum'  => '5',
            'description'  => 'Estrato 5',
        ]);

        factory(Stratum::class)->create([
            'stratum'  => '6',
            'description'  => 'Estrato 6',
        ]);

        factory(Stratum::class)->create([
            'stratum'  => '7',
            'description'  => 'Estrato 7',
        ]);

        factory(Stratum::class)->create([
            'stratum'  => '8',
            'description'  => 'Estrato 8',
        ]);
    }
}
