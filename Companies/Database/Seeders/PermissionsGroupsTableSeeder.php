<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Entities\PermissionGroups\PermissionGroup;

class PermissionsGroupsTableSeeder extends Seeder
{
    public function run()
    {
        factory(PermissionGroup::class)->create([
            'name'        => 'Administrativos',
            'group_order' => 4
        ]);

        factory(PermissionGroup::class)->create([
            'name'        => 'Ecommerce',
            'group_order' => 2
        ]);

        factory(PermissionGroup::class)->create([
            'name'        => 'Pqrs',
            'group_order' => 3
        ]);

        factory(PermissionGroup::class)->create([
            'name'        => 'Clientes',
            'group_order' => 1
        ]);

        factory(PermissionGroup::class)->create([
            'name'        => 'Cursos',
            'group_order' => 5
        ]);

        factory(PermissionGroup::class)->create([
            'name'        => 'Leads',
            'group_order' => 6
        ]);

        factory(PermissionGroup::class)->create([
            'name'        => 'Libranza',
            'group_order' => 7
        ]);
    }
}
