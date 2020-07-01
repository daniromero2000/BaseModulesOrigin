<?php

namespace Modules\Ecommerce\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Ecommerce\Entities\Taxes\Tax;

class TaxesTableSeeder extends Seeder
{
    public function run()
    {
        factory(Tax::class)->create([
            'name' => 'Iva',
            'value' => 0.19,
            'country_id' => 1
        ]);
    }
}
