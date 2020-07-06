<?php

namespace Modules\Ecommerce\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Ecommerce\Entities\ProductGroups\ProductGroup;

class ProductGroupsTableSeeder extends Seeder
{
    public function run()
    {
        factory(ProductGroup::class)->create([
            'name' => 'Outlet',
            'is_active' => 1
        ]);

        factory(ProductGroup::class)->create([
            'name' => 'Nuevos',
            'is_active' => 1
        ]);

        factory(ProductGroup::class)->create([
            'name' => 'Más Popular',
            'is_active' => 1
        ]);
    }
}
