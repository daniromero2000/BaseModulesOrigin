<?php

namespace Modules\CamStudio\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Entities\ActionRole\ActionRole;

class CommunityActionsTableSeeder extends Seeder
{
    public function run()
    {
        // Permisos Acciones Módulo Cammodel Socials
        factory(ActionRole::class)->create([
            'action_id' => 117,
            'role_id' => 6
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 118,
            'role_id' => 6
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 119,
            'role_id' => 6
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 120,
            'role_id' => 6
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 121,
            'role_id' => 6
        ]);

        // Permisos Acciones Módulo Cammodel Streamings
        factory(ActionRole::class)->create([
            'action_id' => 122,
            'role_id' => 6
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 123,
            'role_id' => 6
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 124,
            'role_id' => 6
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 125,
            'role_id' => 6
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 126,
            'role_id' => 6
        ]);
    }
}
