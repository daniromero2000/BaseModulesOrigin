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
        // Módulo Empleados
        $moduleEmployees          =  factory(Permission::class)->create([
            'name'                => 'employees',
            'display_name'        => 'Empleados',
            'icon'                => 'ni ni-single-02 text-orange',
            'permission_group_id' => 1
        ]);

        // Módulo Ciudades
        $moduleCities             =  factory(Permission::class)->create([
            'name'                => 'countries',
            'display_name'        => 'Ciudades',
            'icon'                => 'fas fa-flag',
            'permission_group_id' => 1
        ]);

        // Módulo Sucursales
        $moduleSubsidiaries       =  factory(Permission::class)->create([
            'name'                => 'subsidiaries',
            'display_name'        => 'Sucursales',
            'icon'                => 'fas fa-map-marker',
            'permission_group_id' => 1
        ]);

        // Módulo Roles
        $moduleRoles              =  factory(Permission::class)->create([
            'name'                => 'roles',
            'display_name'        => 'Roles',
            'icon'                => 'fas fa-user-tag',
            'permission_group_id' => 1
        ]);

        // Módulo Permisos
        $modulePermission         =  factory(Permission::class)->create([
            'name'                => 'permissions',
            'display_name'        => 'Permisos',
            'icon'                => 'fas fa-check-double',
            'permission_group_id' => 1
        ]);

        // Módulo PQRS
        $modulePqrs               =  factory(Permission::class)->create([
            'name'                => 'pqrs',
            'display_name'        => 'PQR´s',
            'icon'                => 'fas fa-headset',
            'permission_group_id' => 3
        ]);

        // Módulo PQRS Statuses
        $modulePqrsStatuses       =  factory(Permission::class)->create([
            'name'                => 'pqrs-statuses',
            'display_name'        => 'Estados PQRS',
            'icon'                => 'fas fa-headset',
            'permission_group_id' => 3
        ]);

        // Módulo Customers
        $moduleCustomers          =  factory(Permission::class)->create([
            'name'                => 'customers',
            'display_name'        => 'Clientes',
            'icon'                => 'ni ni-headphones text-blue',
            'permission_group_id' => 4
        ]);

        // Módulo Customers Statuses
        $moduleCustomerStatuses   =  factory(Permission::class)->create([
            'name'                => 'customer-statuses',
            'display_name'        => 'Estados Clientes',
            'icon'                => 'ni ni-favourite-28 text-purple',
            'permission_group_id' => 4
        ]);

        // Módulo Acciones
        $moduleActions            =  factory(Permission::class)->create([
            'name'                => 'actions',
            'display_name'        => 'Acciones',
            'icon'                => 'ni ni-favourite-28 text-purple',
            'permission_group_id' => 1
        ]);

        // Módulo Productos
        $moduleProducts           =  factory(Permission::class)->create([
            'name'                => 'products',
            'display_name'        => 'Productos',
            'icon'                => 'ni ni-shop text-red',
            'permission_group_id' => 2
        ]);

        // Módulo Categorías
        $moduleCategories         =  factory(Permission::class)->create([
            'name'                => 'categories',
            'display_name'        => 'Categorías',
            'icon'                => 'ni ni-books text-info',
            'permission_group_id' => 2
        ]);

        // Módulo Atributos
        $moduleAttributes         =  factory(Permission::class)->create([
            'name'                => 'attributes',
            'display_name'        => 'Atributos',
            'icon'                => 'fas fa-user',
            'permission_group_id' => 2
        ]);

        // Módulo Brands
        $moduleBrands             =  factory(Permission::class)->create([
            'name'                => 'brands',
            'display_name'        => 'Marcas',
            'icon'                => 'fas fa-user',
            'permission_group_id' => 2
        ]);

        // Módulo Brands
        $moduleOrders             =  factory(Permission::class)->create([
            'name'                => 'orders',
            'display_name'        => 'Ordenes',
            'icon'                => 'fas fa-user',
            'permission_group_id' => 2
        ]);

        // Módulo Cursos
        $moduleCourses            =  factory(Permission::class)->create([
            'name'                => 'courses',
            'display_name'        => 'Cursos',
            'icon'                => 'ni ni-single-02 text-orange',
            'permission_group_id' => 5
        ]);

        // Módulo Estudiantes
        $moduleStudents           =  factory(Permission::class)->create([
            'name'                => 'students',
            'display_name'        => 'Estudiantes',
            'icon'                => 'ni ni-single-02 text-orange',
            'permission_group_id' => 5
        ]);

        // Módulo Asistencias
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

        $roleSuperRepo     =  new RoleRepository($super);

        // Permiso Módulo Empleados
        $roleSuperRepo->attachToPermission($moduleEmployees);

        // Permiso Módulo Ciudades
        $roleSuperRepo->attachToPermission($moduleCities);

        // Permiso Módulo Roles
        $roleSuperRepo->attachToPermission($moduleRoles);

        // Permiso Módulo Permisos
        $roleSuperRepo->attachToPermission($modulePermission);

        // Permiso Módulo Pqrs
        $roleSuperRepo->attachToPermission($modulePqrs);

        // Permiso Módulo Pqrs Statuses
        $roleSuperRepo->attachToPermission($modulePqrsStatuses);

        // Permiso Módulo Customers
        $roleSuperRepo->attachToPermission($moduleCustomers);

        // Permiso Módulo Customers Statuses
        $roleSuperRepo->attachToPermission($moduleCustomerStatuses);

        // Permiso Módulo Actions
        $roleSuperRepo->attachToPermission($moduleActions);

        // Permiso Módulo Productos
        $roleSuperRepo->attachToPermission($moduleProducts);

        // Permiso Módulo Categorías
        $roleSuperRepo->attachToPermission($moduleCategories);

        // Permiso Módulo marcas
        $roleSuperRepo->attachToPermission($moduleAttributes);

        // Permiso Módulo marcas
        $roleSuperRepo->attachToPermission($moduleBrands);

        // Permiso Módulo marcas
        $roleSuperRepo->attachToPermission($moduleOrders);

        // Permiso Módulo Cursos
        $roleSuperRepo->attachToPermission($moduleCourses);

        // Permiso Módulo Cursos
        $roleSuperRepo->attachToPermission($moduleStudents);

        // Permiso Módulo Cursos
        $roleSuperRepo->attachToPermission($moduleCourseAttendances);

        $employee->roles()->save($super);





        /*Creacion Usuario Administracion Ecommerce*/
        $employee2          = factory(Employee::class)->create([
            'email'         => 'gerencia@fvn.com.co'
        ]);

        $ecommerceOperative = factory(Role::class)->create([
            'name'          => 'ecommerce_operative',
            'display_name'  => 'Operativo Ecommerce'
        ]);

        $roleAdminRepo      = new RoleRepository($ecommerceOperative);

        // Permiso Módulo Empleados
        $roleAdminRepo->attachToPermission($moduleEmployees);

        // Permiso Módulo Ciudades
        $roleAdminRepo->attachToPermission($moduleCities);

        // Permiso Módulo Sucursales
        $roleAdminRepo->attachToPermission($moduleSubsidiaries);

        // Permiso Módulo Customers Statuses
        $roleAdminRepo->attachToPermission($moduleCustomerStatuses);

        // Permiso Módulo Productos
        $roleAdminRepo->attachToPermission($moduleProducts);

        // Permiso Módulo Categorías
        $roleAdminRepo->attachToPermission($moduleCategories);

        // Permiso Módulo marcas
        $roleAdminRepo->attachToPermission($moduleAttributes);

        // Permiso Módulo marcas
        $roleAdminRepo->attachToPermission($moduleBrands);

        // Permiso Módulo marcas
        $roleAdminRepo->attachToPermission($moduleOrders);

        $employee2->roles()->save($ecommerceOperative);




        /*Creacion Usuario admin cursos*/
        $coursEemployee = factory(Employee::class)->create([
            'email' => 'admin@educorp.com'
        ]);

        $courseadmin = factory(Role::class)->create([
            'name' => 'courses_admin',
            'display_name' => 'Administador de Cursos'
        ]);

        $rolecourseadmin = new RoleRepository($courseadmin);

        // Permiso Módulo Empleados
        $rolecourseadmin->attachToPermission($moduleEmployees);

        // Permiso Módulo Cursos
        $rolecourseadmin->attachToPermission($moduleCourses);

        // Permiso Módulo Estudiantes
        $rolecourseadmin->attachToPermission($moduleStudents);

        // Permiso Módulo Asistencia estudiantes
        $rolecourseadmin->attachToPermission($moduleCourseAttendances);

        $coursEemployee->roles()->save($courseadmin);
    }
}
