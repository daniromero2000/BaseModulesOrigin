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

        factory(Department::class)->create([
            'name' => 'Desarrollo',
        ]);

        factory(Department::class)->create([
            'name' => 'Mantenimiento',
        ]);

        factory(Department::class)->create([
            'name' => 'Canal Digital',
        ]);

        factory(Department::class)->create([
            'name' => 'Seguros',
        ]);

        factory(Department::class)->create([
            'name' => 'Garantias',
        ]);

        factory(Department::class)->create([
            'name' => 'Cartera',
        ]);

        factory(Department::class)->create([
            'name' => 'Unidad Avanzada',
        ]);

        factory(Department::class)->create([
            'name' => 'Oportuya',
        ]);

        factory(Department::class)->create([
            'name'       => 'Libranzas',
            'company_id' => 2
        ]);

        factory(Department::class)->create([
            'name' => 'Ecommercer',
        ]);

        factory(Department::class)->create([
            'name' => 'Juridica',
        ]);

        factory(Department::class)->create([
            'name' => 'CallCenter',
        ]);
    }
}
