<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Entities\Subsidiaries\Subsidiary;

class SubsidiaryTableSeeder extends Seeder
{
    public function run()
    {
        factory(Subsidiary::class)->create();

        factory(Subsidiary::class)->create(
            [
                'company_id'    => 2
            ]
        );
    }
}
