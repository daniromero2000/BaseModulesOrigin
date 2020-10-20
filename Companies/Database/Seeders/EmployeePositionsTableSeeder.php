<?php

namespace Modules\Companies\Database\Seeders;

use Modules\Companies\Entities\EmployeePositions\EmployeePosition;
use Illuminate\Database\Seeder;


class EmployeePositionsTableSeeder extends Seeder
{
    public function run()
    {
        factory(EmployeePosition::class)->create([
            'position' => 'Coordinador',
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Asesor',
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Promotor',
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Gerente Comercial',
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Gerente Financiero',
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Gerente General',
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Contador',
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Manager',
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Modelo',
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Otro',
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Desarrollador',
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Community Manager',
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Diseñador@',
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Jefe de Mantenimiento',
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Auxiliar de Mantenimiento',
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Auxiliar de Administrativa',
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Auxiliar Contable',
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Lider de Mercadeo',
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Fotograf@',
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Audiovisuales@',
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Lider de Desarrollo',
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Desarrollador',
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Gestor Operativo',
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Gestor Comercial',
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Administrador Sede',
        ]);
    }
}
