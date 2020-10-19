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
            'name'        => 'CamStudio',
            'group_order' => 6
        ]);

        factory(PermissionGroup::class)->create([
            'name'        => 'Sislef',
            'group_order' => 7
        ]);

        factory(PermissionGroup::class)->create([
            'name'        => 'XisfoPay',
            'group_order' => 8
        ]);

        factory(PermissionGroup::class)->create([
            'name'        => 'LefemmeCams',
            'group_order' => 9
        ]);

        factory(PermissionGroup::class)->create([
            'name'        => 'TWS',
            'group_order' => 10
        ]);
    }
}
