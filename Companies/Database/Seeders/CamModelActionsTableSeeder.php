<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Entities\ActionRole\ActionRole;

class CamModelActionsTableSeeder extends Seeder
{
    public function run()
    {
        // Permisos Acciones Módulo Cammodels
        factory(ActionRole::class)->create([
            'action_id' => 104,
            'role_id' => 5
        ]);
    }
}
