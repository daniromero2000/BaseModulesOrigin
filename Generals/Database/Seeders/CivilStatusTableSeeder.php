<?php

namespace Modules\Generals\Database\Seeders;

use Modules\Generals\Entities\CivilStatuses\CivilStatus;
use Illuminate\Database\Seeder;

class CivilStatusTableSeeder extends Seeder
{
    public function run()
    {
        factory(CivilStatus::class)->create([
            'civil_status'  => 'Casad@',
        ]);

        factory(CivilStatus::class)->create([
            'civil_status'  => 'Solter@',
        ]);

        factory(CivilStatus::class)->create([
            'civil_status'  => 'Unión Libre',
        ]);

        factory(CivilStatus::class)->create([
            'civil_status'  => 'Divorciad@',
        ]);

        factory(CivilStatus::class)->create([
            'civil_status'  => 'Viud@',
        ]);

        factory(CivilStatus::class)->create([
            'civil_status'  => 'Otro',
        ]);
    }
}
