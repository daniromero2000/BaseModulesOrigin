<?php

namespace Modules\Leads\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Leads\Entities\LeadServices\LeadService;

class LeadServicesTableSeeder extends Seeder
{
    public function run()
    {
        factory(LeadService::class)->create([
            'service'  => 'Contado',
        ]);

        factory(LeadService::class)->create([
            'service'  => 'Crédito',
        ]);

        factory(LeadService::class)->create([
            'service'  => 'Motos',
        ]);

        factory(LeadService::class)->create([
            'service'  => 'Seguros',
        ]);

        factory(LeadService::class)->create([
            'service'  => 'Garantías',
        ]);

        factory(LeadService::class)->create([
            'service'  => 'Información',
        ]);

        factory(LeadService::class)->create([
            'service'  => 'Solicitudes',
        ]);

        factory(LeadService::class)->create([
            'service'  => 'Legal',
        ]);

        factory(LeadService::class)->create([
            'service'  => 'Tarjeta Oportuya',
        ]);

        factory(LeadService::class)->create([
            'service'  => 'Consultas',
        ]);

        factory(LeadService::class)->create([
            'service'  => 'Castigos',
        ]);

        factory(LeadService::class)->create([
            'service'  => 'Solicitud',
        ]);

        factory(LeadService::class)->create([
            'service'  => 'Viajes',
        ]);

        factory(LeadService::class)->create([
            'service'  => 'Credito Libranzas',
        ]);
    }
}
