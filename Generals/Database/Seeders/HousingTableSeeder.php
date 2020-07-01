<?php

namespace Modules\Generals\Database\Seeders;

use Modules\Generals\Entities\Housings\Housing;
use Illuminate\Database\Seeder;

class HousingTableSeeder extends Seeder
{
    public function run()
    {
        factory(Housing::class)->create([
            'housing'  => 'Propia',
        ]);

        factory(Housing::class)->create([
            'housing'  => 'Arrendada',
        ]);

        factory(Housing::class)->create([
            'housing'  => 'Familiar',
        ]);

        factory(Housing::class)->create([
            'housing'  => 'Otro',
        ]);
    }
}
