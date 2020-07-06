<?php

namespace Modules\Customers\Database\Seeders;

use Modules\Customers\Entities\CustomerStatuses\CustomerStatus;
use Illuminate\Database\Seeder;

class CustomerStatusesTableSeeder extends Seeder
{
    public function run()
    {
        factory(CustomerStatus::class)->create([
            'name'  => 'Contactado',
            'color' => 'green'
        ]);

        factory(CustomerStatus::class)->create([
            'name'  => 'Sin Decidir',
            'color' => 'yellow'
        ]);

        factory(CustomerStatus::class)->create([
            'name'  => 'Sin Contactar',
            'color' => 'red'
        ]);

        factory(CustomerStatus::class)->create([
            'name'  => 'Sin enviar Información',
            'color' => 'blue'
        ]);

        factory(CustomerStatus::class)->create([
            'name'  => 'Comprometido',
            'color' => 'grey'
        ]);

        factory(CustomerStatus::class)->create([
            'name'  => 'Re Contactar',
            'color' => 'orange'
        ]);
    }
}
