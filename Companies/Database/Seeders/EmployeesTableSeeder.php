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
        $moduleEmployees          =  factory(Permission::class)->create([
            'name'                => 'employees',
            'display_name'        => 'Empleados',
            'icon'                => 'ni ni-single-02 text-orange',
            'permission_group_id' => 1
        ]);

        $moduleCities             =  factory(Permission::class)->create([
            'name'                => 'countries',
            'display_name'        => 'Ciudades',
            'icon'                => 'fas fa-flag',
            'permission_group_id' => 1
        ]);

        $moduleSubsidiaries       =  factory(Permission::class)->create([
            'name'                => 'subsidiaries',
            'display_name'        => 'Sucursales',
            'icon'                => 'fas fa-map-marker',
            'permission_group_id' => 1
        ]);

        $moduleRoles              =  factory(Permission::class)->create([
            'name'                => 'roles',
            'display_name'        => 'Roles',
            'icon'                => 'fas fa-user-tag',
            'permission_group_id' => 1
        ]);

        $modulePermission         =  factory(Permission::class)->create([
            'name'                => 'permissions',
            'display_name'        => 'Permisos',
            'icon'                => 'fas fa-check-double',
            'permission_group_id' => 1
        ]);

        $modulePqrs               =  factory(Permission::class)->create([
            'name'                => 'pqrs',
            'display_name'        => 'PQR´s',
            'icon'                => 'fas fa-headset',
            'permission_group_id' => 3
        ]);

        $modulePqrsStatuses       =  factory(Permission::class)->create([
            'name'                => 'pqrs-statuses',
            'display_name'        => 'Estados PQRS',
            'icon'                => 'fas fa-headset',
            'permission_group_id' => 3
        ]);

        $moduleCustomers          =  factory(Permission::class)->create([
            'name'                => 'customers',
            'display_name'        => 'Clientes',
            'icon'                => 'ni ni-headphones text-blue',
            'permission_group_id' => 4
        ]);

        $moduleCustomerStatuses   =  factory(Permission::class)->create([
            'name'                => 'customer-statuses',
            'display_name'        => 'Estados Clientes',
            'icon'                => 'ni ni-favourite-28 text-purple',
            'permission_group_id' => 4
        ]);

        $moduleActions            =  factory(Permission::class)->create([
            'name'                => 'actions',
            'display_name'        => 'Acciones',
            'icon'                => 'ni ni-favourite-28 text-purple',
            'permission_group_id' => 1
        ]);

        $moduleProducts           =  factory(Permission::class)->create([
            'name'                => 'products',
            'display_name'        => 'Productos',
            'icon'                => 'ni ni-shop text-red',
            'permission_group_id' => 2
        ]);

        $moduleCategories         =  factory(Permission::class)->create([
            'name'                => 'categories',
            'display_name'        => 'Categorías',
            'icon'                => 'ni ni-books text-info',
            'permission_group_id' => 2
        ]);

        $moduleAttributes         =  factory(Permission::class)->create([
            'name'                => 'attributes',
            'display_name'        => 'Atributos',
            'icon'                => 'fas fa-user',
            'permission_group_id' => 2
        ]);

        $moduleBrands             =  factory(Permission::class)->create([
            'name'                => 'brands',
            'display_name'        => 'Marcas',
            'icon'                => 'fas fa-user',
            'permission_group_id' => 2
        ]);

        $moduleOrders             =  factory(Permission::class)->create([
            'name'                => 'orders',
            'display_name'        => 'Ordenes',
            'icon'                => 'fas fa-user',
            'permission_group_id' => 2
        ]);

        $moduleCourses            =  factory(Permission::class)->create([
            'name'                => 'courses',
            'display_name'        => 'Cursos',
            'icon'                => 'ni ni-single-02 text-orange',
            'permission_group_id' => 5
        ]);

        $moduleStudents           =  factory(Permission::class)->create([
            'name'                => 'students',
            'display_name'        => 'Estudiantes',
            'icon'                => 'ni ni-single-02 text-orange',
            'permission_group_id' => 5
        ]);

        $moduleCourseAttendances  =  factory(Permission::class)->create([
            'name'                => 'course_attendances',
            'display_name'        => 'Asistencias',
            'icon'                => 'ni ni-single-02 text-orange',
            'permission_group_id' => 5
        ]);




        /*Creacion Usuario Super Admin Desarrollo*/
        $employee          =  factory(Employee::class)->create([
            'email'        => 'desarrollo@smartcommerce.com.co'
        ]);

        $super             =  factory(Role::class)->create([
            'name'         => 'superadmin',
            'display_name' => 'Super Admin'
        ]);

        $roleSuperRepo =  new RoleRepository($super);
        $roleSuperRepo->attachToPermission($moduleEmployees);
        $roleSuperRepo->attachToPermission($moduleCities);
        $roleSuperRepo->attachToPermission($moduleRoles);
        $roleSuperRepo->attachToPermission($modulePermission);
        $roleSuperRepo->attachToPermission($modulePqrs);
        $roleSuperRepo->attachToPermission($modulePqrsStatuses);
        $roleSuperRepo->attachToPermission($moduleCustomers);
        $roleSuperRepo->attachToPermission($moduleCustomerStatuses);
        $roleSuperRepo->attachToPermission($moduleActions);
        $roleSuperRepo->attachToPermission($moduleProducts);
        $roleSuperRepo->attachToPermission($moduleCategories);
        $roleSuperRepo->attachToPermission($moduleAttributes);
        $roleSuperRepo->attachToPermission($moduleBrands);
        $roleSuperRepo->attachToPermission($moduleOrders);
        $roleSuperRepo->attachToPermission($moduleCourses);
        $roleSuperRepo->attachToPermission($moduleStudents);
        $roleSuperRepo->attachToPermission($moduleCourseAttendances);
        $employee->roles()->save($super);


        /*Creacion Usuario Administracion Ecommerce*/
        $employee2          = factory(Employee::class)->create([
            'email'         => 'gerencia@fvn.com.co'
        ]);

        $ecommerceOperative = factory(Role::class)->create([
            'name'          => 'ecommerce_admin',
            'display_name'  => 'Admin Ecommerce'
        ]);

        $roleAdminRepo = new RoleRepository($ecommerceOperative);
        $roleAdminRepo->attachToPermission($moduleEmployees);
        $roleAdminRepo->attachToPermission($moduleCities);
        $roleAdminRepo->attachToPermission($moduleSubsidiaries);
        $roleAdminRepo->attachToPermission($moduleCustomerStatuses);
        $roleAdminRepo->attachToPermission($moduleProducts);
        $roleAdminRepo->attachToPermission($moduleCategories);
        $roleAdminRepo->attachToPermission($moduleAttributes);
        $roleAdminRepo->attachToPermission($moduleBrands);
        $roleAdminRepo->attachToPermission($moduleOrders);
        $employee2->roles()->save($ecommerceOperative);


        /*Creacion Usuario admin cursos*/
        $coursEemployee    =  factory(Employee::class)->create([
            'email'        => 'admin@educorp.com'
        ]);

        $courseadmin       =  factory(Role::class)->create([
            'name'         => 'courses_admin',
            'display_name' => 'Administador de Cursos'
        ]);

        $rolecourseadmin = new RoleRepository($courseadmin);
        $rolecourseadmin->attachToPermission($moduleEmployees);
        $rolecourseadmin->attachToPermission($moduleCourses);
        $rolecourseadmin->attachToPermission($moduleStudents);
        $rolecourseadmin->attachToPermission($moduleCourseAttendances);
        $coursEemployee->roles()->save($courseadmin);
    }
}
