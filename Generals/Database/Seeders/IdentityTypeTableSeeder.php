<?php

namespace Modules\Generals\Database\Seeders;

use Modules\Generals\Entities\IdentityTypes\IdentityType;
use Illuminate\Database\Seeder;

class IdentityTypeTableSeeder extends Seeder
{
    public function run()
    {
        factory(IdentityType::class)->create([
            'identity_type'  => 'Cédula de Ciudadanía',
        ]);

        factory(IdentityType::class)->create([
            'identity_type'  => 'Tarjeta de Identidad',
        ]);

        factory(IdentityType::class)->create([
            'identity_type'  => 'Pasaporte',
        ]);
    }
}
