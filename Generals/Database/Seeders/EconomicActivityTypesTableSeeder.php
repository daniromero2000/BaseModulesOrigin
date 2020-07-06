<?php

namespace Modules\Generals\Database\Seeders;

use Modules\Generals\Entities\EconomicActivityTypes\EconomicActivityType;
use Illuminate\Database\Seeder;

class EconomicActivityTypesTableSeeder extends Seeder
{
    public function run()
    {
        factory(EconomicActivityType::class)->create([
            'economic_activity_type'  => 'Empleado',
        ]);

        factory(EconomicActivityType::class)->create([
            'economic_activity_type'  => 'Fuerzas Armadas-Policia',
        ]);

        factory(EconomicActivityType::class)->create([
            'economic_activity_type'  => 'Prestación de Servicios',
        ]);

        factory(EconomicActivityType::class)->create([
            'economic_activity_type'  => 'Independiente Certificado',
        ]);

        factory(EconomicActivityType::class)->create([
            'economic_activity_type'  => 'Independiente NO Certificado',
        ]);

        factory(EconomicActivityType::class)->create([
            'economic_activity_type'  => 'Rentista',
        ]);

        factory(EconomicActivityType::class)->create([
            'economic_activity_type'  => 'Pensionado',
        ]);

        factory(EconomicActivityType::class)->create([
            'economic_activity_type'  => 'Otro',
        ]);
    }
}
