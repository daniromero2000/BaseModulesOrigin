<?php

namespace Modules\Ecommerce\Database\Seeders;

use Modules\Companies\Entities\Employees\Employee;
use Modules\Companies\Entities\Permissions\Permission;
use Modules\Companies\Entities\Roles\Repositories\RoleRepository;
use Modules\Companies\Entities\Roles\Role;
use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    public function run()
    {
        /*Creacion Usuario Administracion Ecommerce*/
        $employee2          = factory(Employee::class)->create([
            'email'         => 'gerencia@fvn.com.co'
        ]);

        $ecommerceOperative = factory(Role::class)->create([
            'name'          => 'ecommerce_admin',
            'display_name'  => 'Admin Ecommerce'
        ]);

        $moduleEcommerceOperative = ['1', '3', '8', '9', '11', '12', '13', '14', '15', '19', '20', '21', '22', '25'];

        $roleAdminRepo = new RoleRepository($ecommerceOperative);
        $roleAdminRepo->syncPermissions($moduleEcommerceOperative);
        $employee2->roles()->save($ecommerceOperative);
    }
}
