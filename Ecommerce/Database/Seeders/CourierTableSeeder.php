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
    }
}
