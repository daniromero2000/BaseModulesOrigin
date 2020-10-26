<?php

namespace Modules\CamStudio\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\CamStudio\Entities\CammodelCategories\CammodelCategory;

class CamModelCategoriesTableSeeder extends Seeder
{
    public function run()
    {
        factory(CammodelCategory::class)->create();
    }
}
