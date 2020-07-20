<?php

namespace Modules\Ecommerce\Database\Seeders;

use Modules\Ecommerce\Entities\Brands\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    public function run()
    {
        factory(Brand::class)->create([
            'name' => 'FVN'
        ]);
    }
}
