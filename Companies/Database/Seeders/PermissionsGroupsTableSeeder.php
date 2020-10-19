<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Entities\PermissionGroups\PermissionGroup;

class CompanyTableSeeder extends Seeder
{
    public function run()
    {
        $permissionGroupAdmon = factory(PermissionGroup::class)->create([
            'name'        => 'Administrativos',
            'group_order' => 4
        ]);

        $permissionGroupCatalog = factory(PermissionGroup::class)->create([
            'name'        => 'Ecommerce',
            'group_order' => 2
        ]);

        $permissionGroupPqrs = factory(PermissionGroup::class)->create([
            'name'        => 'Pqrs',
            'group_order' => 3
        ]);

        $permissionGroupCustomers = factory(PermissionGroup::class)->create([
            'name'        => 'Clientes',
            'group_order' => 1
        ]);

        $permissionGroupCourses = factory(PermissionGroup::class)->create([
            'name'        => 'Cursos',
            'group_order' => 5
        ]);

        $permissionGroupCamStudio = factory(PermissionGroup::class)->create([
            'name'        => 'CamStudio',
            'group_order' => 6
        ]);
    }
}
