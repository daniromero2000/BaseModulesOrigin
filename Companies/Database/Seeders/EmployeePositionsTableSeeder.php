<?php

namespace Modules\Companies\Database\Seeders;

use Modules\Companies\Entities\EmployeePositions\EmployeePosition;
use Illuminate\Database\Seeder;


class EmployeePositionsTableSeeder extends Seeder
{
    public function run()
    {
        factory(EmployeePosition::class)->create([
            'position' => 'Asesor',
            'department_id' => 9
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Asesor',
            'department_id' => 9
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Promotor',
            'department_id' => 9
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Gerente Comercial',
            'department_id' => 2
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Gerente Financiero',
            'department_id' => 2
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Gerente General',
            'department_id' => 2
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Contador',
            'department_id' => 3
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Manager',
            'department_id' => 2
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Modelo',
            'department_id' => 9
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Desarrollador',
            'department_id' => 6
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Community Manager',
            'department_id' => 5
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Diseñad(or/ora)',
            'department_id' => 5
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Jefe de Mantenimiento',
            'department_id' => 11
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Auxiliar de Mantenimiento',
            'department_id' => 11
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Auxiliar de Administrativa',
            'department_id' => 2
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Auxiliar Contable',
            'department_id' => 3
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Lider de Mercadeo',
            'department_id' => 5
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Fotograf(a/o)',
            'department_id' => 5
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Audiovisuales',
            'department_id' => 5
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Lider de Desarrollo',
            'department_id' => 6
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Gestor Operativo',
            'department_id' => 9
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Gestor Comercial',
            'department_id' => 9
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Administrador de sede',
            'department_id' => 2
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Lider',
            'department_id' => 17
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Asesor',
            'department_id' => 17
        ]);

    }
}
