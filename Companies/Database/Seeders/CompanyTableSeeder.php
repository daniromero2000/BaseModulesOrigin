<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Entities\Companies\Company;

class CompanyTableSeeder extends Seeder
{
    public function run()
    {
        factory(Company::class)->create();

        factory(Company::class)->create([
            'name' => 'Libranzas Bogotá',
            'country_id' => 1,
            'currency_id' => 3,
            'identification' => 1234567,
            'company_type' => 'Administrativo',
        ]);
    }
}
