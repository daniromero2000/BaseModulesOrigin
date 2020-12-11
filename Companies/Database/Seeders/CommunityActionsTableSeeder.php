<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Entities\ActionRole\ActionRole;

class CommunityActionsTableSeeder extends Seeder
{
    public function run()
    {
        // Permisos Acciones Módulo Cammodel Socials
        factory(ActionRole::class)->create([
            'action_id' => 106,
            'role_id' => 3
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 107,
            'role_id' => 3
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 108,
            'role_id' => 3
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 109,
            'role_id' => 3
        ]);

        factory(ActionRole::class)->create([
            'action_id' => 110,
            'role_id' => 3
        ]);
    }
}
