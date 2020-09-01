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
            'position' => 'Gerente',
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Gerente Comercial',
        ]);

        factory(EmployeePosition::class)->create([
            'position' => 'Gerente Financiero',
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
    }
}
