<?php

namespace Modules\Ecommerce\Database\Seeders;

use Modules\Ecommerce\Entities\Couriers\Courier;
use Illuminate\Database\Seeder;

class CourierTableSeeder extends Seeder
{
    public function run()
    {
        factory(Courier::class)->create([
            'name' => 'Envío Gratis',
            'description' => 'Envío Gratis'
        ]);

        factory(Courier::class)->create([
            'name' => 'Regional',
            'description' => 'Envío Eje Cafetero',
            'is_free' => 0,
            'cost' => 7000
        ]);

        factory(Courier::class)->create([
            'name' => 'Nacional',
            'description' => 'Envío Nacional',
            'is_free' => 0,
            'cost' => 9000
        ]);
    }
}
