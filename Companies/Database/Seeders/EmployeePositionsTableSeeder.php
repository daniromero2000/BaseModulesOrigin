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
      'position' => 'Otro',
    ]);
  }
}
