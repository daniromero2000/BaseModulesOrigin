<?php

namespace Modules\Leads\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Leads\Entities\LeadStatuses\LeadStatus;

class LeadStatusesTableSeeder extends Seeder
{
    public function run()
    {
        factory(LeadStatus::class)->create([
            'status'  => 'Contactado',
            'color' => '#ffffff',
            'background' => '#316fcb'
        ]);

        factory(LeadStatus::class)->create([
            'status'  => 'Vendido',
            'color' => '#ffffff',
            'background' => '#0bb010'
        ]);

        factory(LeadStatus::class)->create([
            'status'  => 'Asignado a:',
            'color' => '#ffffff',
            'background' => '#ff9900'
        ]);

        factory(LeadStatus::class)->create([
            'status'  => 'Impactado',
            'color' => '#ffffff',
            'background' => '#007bff'
        ]);

        factory(LeadStatus::class)->create([
            'status'  => 'Desistido',
            'color' => '#ffffff',
            'background' => '#da29b4'
        ]);

        factory(LeadStatus::class)->create([
            'status'  => 'Negado',
            'color' => '#ffffff',
            'background' => '#da2929'
        ]);

        factory(LeadStatus::class)->create([
            'status'  => 'Cotizado',
            'color' => '#ffffff',
            'background' => '#d81b60'
        ]);

        factory(LeadStatus::class)->create([
            'status'  => 'En Gestión',
            'color' => '#ffffff',
            'background' => '#20a2c9'
        ]);

        factory(LeadStatus::class)->create([
            'status'  => 'Cerrado',
            'color' => '#ffffff',
            'background' => '#b0130b'
        ]);

        factory(LeadStatus::class)->create([
            'status'  => 'Sin Respuesta',
            'color' => '#ffffff',
            'background' => '#b0130b'
        ]);

        factory(LeadStatus::class)->create([
            'status'  => 'Solucionado',
            'color' => '#ffffff',
            'background' => '#0bb010'
        ]);

        factory(LeadStatus::class)->create([
            'status'  => 'Pendiente',
            'color' => '#ffffff',
            'background' => '#ff9900'
        ]);

        factory(LeadStatus::class)->create([
            'status'  => 'Pendiente Respuesta Proveedor',
            'color' => '#ffffff',
            'background' => '#ff9900'
        ]);

        factory(LeadStatus::class)->create([
            'status'  => 'Volver a llamar',
            'color' => '#ffffff',
            'background' => '#20a2c9'
        ]);
    }
}
