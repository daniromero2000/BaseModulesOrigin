<?php

namespace Modules\Generals\Database\Seeders;

use Modules\Generals\Entities\IdentityTypes\IdentityType;
use Illuminate\Database\Seeder;

class IdentityTypeTableSeeder extends Seeder
{
    public function run()
    {
        factory(IdentityType::class)->create([
            'identity_type' => 'Cédula de Ciudadanía',
            'initials'      => 'CC'

        ]);

        factory(IdentityType::class)->create([
            'identity_type' => 'Tarjeta de Identidad',
            'initials'      => 'TI'
        ]);

        factory(IdentityType::class)->create([
            'identity_type' => 'Pasaporte',
            'initials'      => 'Pasaporte'
        ]);

        factory(IdentityType::class)->create([
            'identity_type' => 'Cédula de Estranjería',
            'initials'      => 'CE'
        ]);

        factory(IdentityType::class)->create([
            'identity_type' => 'NIT',
            'initials'      => 'NIT'
        ]);

        factory(IdentityType::class)->create([
            'identity_type' => 'RUT',
            'initials'      => 'RUT'
        ]);
    }
}
