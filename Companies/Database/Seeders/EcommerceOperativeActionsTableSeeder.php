<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Entities\ActionRole\ActionRole;

class EcommerceOperativeActionsTableSeeder extends Seeder
{
    public function run()
    {
        // Permisos Acciones Módulo Empleados
        factory(ActionRole::class)->create([
            'action_id' => 1,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 2,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 3,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 4,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 5,
            'role_id' => 2
        ]);

        // Permisos Acciones Módulo Ciudades
        factory(ActionRole::class)->create([
            'action_id' => 6,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 7,
            'role_id' => 2
        ]);

        // Permisos Acciones Módulo Sucursales
        factory(ActionRole::class)->create([
            'action_id' => 8,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 9,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 10,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 11,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 12,
            'role_id' => 2
        ]);

        // Permisos Acciones Módulo Customer
        factory(ActionRole::class)->create([
            'action_id' => 32,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 33,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 34,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 35,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 36,
            'role_id' => 2
        ]);

        // Permisos Acciones Módulo Customer Statuses

        factory(ActionRole::class)->create([
            'action_id' => 37,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 38,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 39,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 40,
            'role_id' => 2
        ]);



        // Permisos Acciones Módulo Productos
        factory(ActionRole::class)->create([
            'action_id' => 46,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 47,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 48,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 49,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 50,
            'role_id' => 2
        ]);



        // Permisos Acciones Módulo Categorías
        factory(ActionRole::class)->create([
            'action_id' => 51,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 52,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 53,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 54,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 55,
            'role_id' => 2
        ]);


        // Permisos Acciones Módulo marcas
        factory(ActionRole::class)->create([
            'action_id' => 56,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 57,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 58,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 59,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 60,
            'role_id' => 2
        ]);



        // Permisos Acciones Módulo marcas
        factory(ActionRole::class)->create([
            'action_id' => 61,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 62,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 63,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 64,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 65,
            'role_id' => 2
        ]);


        // Permisos Acciones Módulo marcas
        factory(ActionRole::class)->create([
            'action_id' => 66,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 67,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 68,
            'role_id' => 2
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 69,
            'role_id' => 2
        ]);
    }
}
