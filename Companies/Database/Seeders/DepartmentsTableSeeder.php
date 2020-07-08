<?php

namespace Modules\Companies\Database\Seeders;


use Modules\Companies\Entities\Departments\Department;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    public function run()
    {
        factory(Department::class)->create([
            'name' => 'Recursos Humanos',
        ]);

        factory(Department::class)->create([
            'name' => 'Dirección Administrativa',
        ]);

        factory(Department::class)->create([
            'name' => 'Contabilidad y Finanzas',
        ]);

        factory(Department::class)->create([
            'name' => 'Producción',
        ]);

        factory(Department::class)->create([
            'name' => 'Marketing Y Publicidad',
        ]);

        factory(Department::class)->create([
            'name' => 'Tecnologías de la Información',
        ]);

        factory(Department::class)->create([
            'name' => 'Servicio al Cliente',
        ]);

        factory(Department::class)->create([
            'name' => 'Compras',
        ]);

        factory(Department::class)->create([
            'name' => 'Comercial',
        ]);
    }
}
