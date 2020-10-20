<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Entities\ActionRole\ActionRole;

class CoursesAdminActionsTableSeeder extends Seeder
{
    public function run()
    {
        // Permisos Acciones Módulo Cursos
        factory(ActionRole::class)->create([
            'action_id' => 70,
            'role_id' => 3
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 71,
            'role_id' => 3
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 72,
            'role_id' => 3
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 73,
            'role_id' => 3
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 74,
            'role_id' => 3
        ]);

        // Permisos Acciones Módulo Cursos
        factory(ActionRole::class)->create([
            'action_id' => 75,
            'role_id' => 3
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 76,
            'role_id' => 3
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 77,
            'role_id' => 3
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 78,
            'role_id' => 3
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 79,
            'role_id' => 3
        ]);

        // Permisos Acciones Módulo Cursos
        factory(ActionRole::class)->create([
            'action_id' => 80,
            'role_id' => 3
        ]);

        // Permisos Acciones Módulo modelos
        factory(ActionRole::class)->create([
            'action_id' => 104,
            'role_id' => 3
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 105,
            'role_id' => 3
        ]);
    }
}
