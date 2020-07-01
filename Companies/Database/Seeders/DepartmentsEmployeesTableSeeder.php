<?php

namespace Modules\Companies\Database\Seeders;

use Modules\Companies\Entities\DepartmentsEmployees\DepartmentEmployee;
use Illuminate\Database\Seeder;

class DepartmentsEmployeesTableSeeder extends Seeder
{
	public function run()
	{
		factory(DepartmentEmployee::class)->create([
			'department_id' => '1',
			'employee_id' => '1',
		]);
	}
}
