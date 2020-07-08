<?php

namespace Modules\Ecommerce\Database\Seeders;

use Modules\Ecommerce\Entities\OrderStatuses\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusTableSeeder extends Seeder
{
    public function run()
    {
        factory(OrderStatus::class)->create([
            'name' => 'Pagado',
            'color' => 'green'
        ]);

        factory(OrderStatus::class)->create([
            'name' => 'Pendiente',
            'color' => 'yellow'
        ]);

        factory(OrderStatus::class)->create([
            'name' => 'error',
            'color' => 'red'
        ]);

        factory(OrderStatus::class)->create([
            'name' => 'En entrega',
            'color' => 'blue'
        ]);

        factory(OrderStatus::class)->create([
            'name' => 'Ordenado',
            'color' => 'violet'
        ]);
    }
}
