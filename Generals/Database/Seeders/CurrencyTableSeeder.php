<?php

namespace Modules\Generals\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Generals\Entities\Currencies\Currency;

class CurrencyTableSeeder extends Seeder
{
    public function run()
    {
        factory(Currency::class)->create([
            'iso'   => 'USD',
            'name'   => 'US Dollar',
            'symbol' => '$',
        ]);

        factory(Currency::class)->create([
            'iso'   => 'EUR',
            'name'   => 'Euro',
            'symbol' => '€',
        ]);

        factory(Currency::class)->create([
            'iso'   => 'COP',
            'name'   => 'Colombian peso',
            'symbol' => '€',
        ]);
    }
}
