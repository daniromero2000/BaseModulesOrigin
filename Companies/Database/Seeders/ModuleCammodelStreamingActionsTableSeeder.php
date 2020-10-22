<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Entities\Actions\Action;

class ModuleCammodelStreamingActionsTableSeeder extends Seeder
{
    public function run()
    {
        // Acciones Módulo CamModel Social
        factory(Action::class)->create([
            'permission_id' => 29,
            'name'          => 'Ver Streamings',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.cammodel-streamings.index',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 29,
            'name'      => 'Crear Streaming',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.cammodel-streamings.create',
            'principal' => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 29,
            'name'          => 'Editar Streaming',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.cammodel-streamings.edit',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 29,
            'name'          => 'Ver Streaming',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.cammodel-streamings.show',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 29,
            'name'          => 'Borrar Streaming',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.cammodel-streamings.destroy',
            'principal'     => 0
        ]);
    }
}
