<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Entities\ActionRole\ActionRole;

class CamModelActionsTableSeeder extends Seeder
{
    public function run()
    {
        // Permisos Acciones Módulo Ciudades
        factory(ActionRole::class)->create([
            'action_id' => 6,
            'role_id' => 5
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 7,
            'role_id' => 5
        ]);


        // Permisos Acciones Módulo Cammodels
        factory(ActionRole::class)->create([
            'action_id' => 100,
            'role_id' => 5
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 101,
            'role_id' => 5
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 102,
            'role_id' => 5
        ]);
    }
}
