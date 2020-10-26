<?php

namespace Modules\Courses\Database\Seeders;

use Modules\Companies\Entities\Employees\Employee;
use Modules\Companies\Entities\Roles\Repositories\RoleRepository;
use Modules\Companies\Entities\Roles\Role;
use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    public function run()
    {
        /*Creacion Usuario admin cursos*/
        $coursEemployee    =  factory(Employee::class)->create([
            'email'        => 'admin@educorp.com'
        ]);

        $courseadmin       =  factory(Role::class)->create([
            'name'         => 'courses_admin',
            'display_name' => 'Administador de Cursos',
            'status'       => 0
        ]);

        $moduleCourses = ['1', '16', '17', '18', '25'];

        $rolecourseadmin = new RoleRepository($courseadmin);
        $rolecourseadmin->syncPermissions($moduleCourses);
        $coursEemployee->roles()->save($courseadmin);
    }
}
