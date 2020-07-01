<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Entities\Companies\Company;

class CompanyTableSeeder extends Seeder
{
    public function run()
    {
        factory(Company::class)->create();
    }
}
