<?php

namespace Modules\Companies\Database\Seeders;

use Modules\Companies\Entities\Employees\Employee;
use Modules\Companies\Entities\Permissions\Permission;
use Modules\Companies\Entities\Roles\Repositories\RoleRepository;
use Modules\Companies\Entities\Roles\Role;
use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    public function run()
    {
        /*Creacion Usuario Super Admin Desarrollo*/
        $employee          =  factory(Employee::class)->create([
            'email'        => 'desarrollo@smartcommerce.com.co'
        ]);

        $super             =  factory(Role::class)->create([
            'name'         => 'superadmin',
            'display_name' => 'Super Admin',
            'status'       => 0
        ]);

        $moduleSuperadmin = [
            '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11',
            '12', '13', '14', '15', '16', '17', '18', '19', '20', '21',
            '22', '23', '24', '25', '26', '27', '28', '29'
        ];

        $roleSuperRepo =  new RoleRepository($super);
        $roleSuperRepo->syncPermissions($moduleSuperadmin);
        $employee->roles()->save($super);


        /*Creacion Usuario sin acceso*/
        $noAccessEemployee    =  factory(Employee::class)->create([
            'email'        => 'admin@sycgroup.com'
        ]);

        $noAccess       =  factory(Role::class)->create([
            'name'         => 'no_access',
            'display_name' => 'Sin Acceso'
        ]);

        $roleNoAccess = new RoleRepository($noAccess);
        $noAccessEemployee->roles()->save($noAccess);
    }
}
