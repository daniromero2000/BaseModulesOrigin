<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Entities\Actions\Action;

class ModuleInterviewsActionsTableSeeder extends Seeder
{
    public function run()
    {
        // Acciones Módulo Entrevistas
        factory(Action::class)->create([
            'permission_id' => 26,
            'name'          => 'Ver Entrevistas',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.interviews.index',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 26,
            'name'      => 'Crear Entrevista',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.interviews.create',
            'principal' => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 26,
            'name'          => 'Editar Entrevista',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.interviews.edit',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 26,
            'name'          => 'Ver Entrevista',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.interviews.show',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 26,
            'name'          => 'Borrar Entrevista',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.interviews.destroy',
            'principal'     => 0
        ]);

        // Acciones Módulo esstados Entrevistas
        factory(Action::class)->create([
            'permission_id' => 27,
            'name'          => 'Ver Estados Entrevistas',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.interview-statuses.index',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 27,
            'name'      => 'Crear Estado Entrevista',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.interview-statuses.create',
            'principal' => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 27,
            'name'          => 'Editar Estado Entrevista',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.interview-statuses.edit',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 27,
            'name'          => 'Ver Estado Entrevista',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.interview-statuses.show',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 27,
            'name'          => 'Borrar Estado Entrevista',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.interview-statuses.destroy',
            'principal'     => 0
        ]);
    }
}
