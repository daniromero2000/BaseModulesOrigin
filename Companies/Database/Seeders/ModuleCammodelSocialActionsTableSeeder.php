<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Entities\Actions\Action;

class ModuleCammodelSocialActionsTableSeeder extends Seeder
{
    public function run()
    {
        // Acciones Módulo CamModel Social
        factory(Action::class)->create([
            'permission_id' => 28,
            'name'          => 'Ver Redes Sociales',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.cammodel-social.index',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 28,
            'name'      => 'Crear Red Social',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.cammodel-social.create',
            'principal' => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 28,
            'name'          => 'Editar Red Social',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.cammodel-social.edit',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 28,
            'name'          => 'Ver Red Social',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.cammodel-social.show',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 28,
            'name'          => 'Borrar Red Social',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.cammodel-social.destroy',
            'principal'     => 0
        ]);
    }
}
