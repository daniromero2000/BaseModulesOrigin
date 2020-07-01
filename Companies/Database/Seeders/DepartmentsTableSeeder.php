<?php

namespace Modules\Companies\Database\Seeders;


use Modules\Companies\Entities\Departments\Department;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    public function run()
    {
        factory(Department::class)->create();
    }
}
