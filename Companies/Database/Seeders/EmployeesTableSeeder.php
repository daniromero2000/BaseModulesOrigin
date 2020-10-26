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
            'icon'                => 'fas fa-user-tie',
            'permission_group_id' => 1
        ]);

        $moduleCities             =  factory(Permission::class)->create([
            'name'                => 'countries',
            'display_name'        => 'Ciudades',
            'icon'                => 'fas fa-city',
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
            'name'                => 'pqrs_statuses',
            'display_name'        => 'Estados_PQR´s',
            'icon'                => 'fas fa-headset',
            'permission_group_id' => 3
        ]);

        $moduleCustomers          =  factory(Permission::class)->create([
            'name'                => 'customers',
            'display_name'        => 'Clientes',
            'icon'                => 'ni ni-headphones',
            'permission_group_id' => 4
        ]);

        $moduleCustomerStatuses   =  factory(Permission::class)->create([
            'name'                => 'customer_statuses',
            'display_name'        => 'Estados_clientes',
            'icon'                => 'ni ni-favourite-28',
            'permission_group_id' => 4
        ]);

        $moduleActions            =  factory(Permission::class)->create([
            'name'                => 'actions',
            'display_name'        => 'Acciones',
            'icon'                => 'fas fa-chalkboard-teacher',
            'permission_group_id' => 1
        ]);

        $moduleProducts           =  factory(Permission::class)->create([
            'name'                => 'products',
            'display_name'        => 'Productos',
            'icon'                => 'ni ni-shop',
            'permission_group_id' => 2
        ]);

        $moduleProductCategories  =  factory(Permission::class)->create([
            'name'                => 'product_categories',
            'display_name'        => 'Categorías_productos',
            'icon'                => 'ni ni-books',
            'permission_group_id' => 2
        ]);

        $moduleAttributes         =  factory(Permission::class)->create([
            'name'                => 'attributes',
            'display_name'        => 'Atributos',
            'icon'                => 'fas fa-award',
            'permission_group_id' => 2
        ]);

        $moduleBrands             =  factory(Permission::class)->create([
            'name'                => 'brands',
            'display_name'        => 'Marcas',
            'icon'                => 'fas fa-tags',
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
            'icon'                => 'fas fa-book-reader',
            'permission_group_id' => 5
        ]);

        $moduleStudents           =  factory(Permission::class)->create([
            'name'                => 'students',
            'display_name'        => 'Estudiantes',
            'icon'                => 'fas fa-user-graduate',
            'permission_group_id' => 5
        ]);

        $moduleCourseAttendances  =  factory(Permission::class)->create([
            'name'                => 'course_attendances',
            'display_name'        => 'Asistencias',
            'icon'                => 'fas fa-user-check',
            'permission_group_id' => 5
        ]);

        $moduleWishlists          =  factory(Permission::class)->create([
            'name'                => 'wishlist',
            'display_name'        => 'Wishlists',
            'icon'                => 'fas fa-heart',
            'permission_group_id' => 2
        ]);

        $moduleCheckouts          =  factory(Permission::class)->create([
            'name'                => 'checkouts',
            'display_name'        => 'Checkouts',
            'icon'                => 'fas fa-shopping-bag',
            'permission_group_id' => 2
        ]);

        $moduleOrderShipments     =  factory(Permission::class)->create([
            'name'                => 'order_shipments',
            'display_name'        => 'Despachos',
            'icon'                => 'fas fa-share-square',
            'permission_group_id' => 2
        ]);

        $moduleProductReviews     =  factory(Permission::class)->create([
            'name'                => 'product_reviews',
            'display_name'        => 'Calificación_productos',
            'icon'                => 'fas fa-star',
            'permission_group_id' => 2
        ]);

        $moduleCamModelCategories =  factory(Permission::class)->create([
            'name'                => 'cam_model_categories',
            'display_name'        => 'Categorías modelos',
            'icon'                => 'ni ni-books',
            'permission_group_id' => 9
        ]);

        $moduleCamModels          =  factory(Permission::class)->create([
            'name'                => 'cam_models',
            'display_name'        => 'Modelos',
            'icon'                => 'fas fa-female',
            'permission_group_id' => 9
        ]);

        $moduleNewsletterSubscriptions         =  factory(Permission::class)->create([
            'name'                => 'newsletter_subscriptions',
            'display_name'        => 'Subscripciones',
            'icon'                => 'ni ni-single-02',
            'permission_group_id' => 4
        ]);

        $moduleInterviews        =  factory(Permission::class)->create([
            'name'                => 'interviews',
            'display_name'        => 'Entrevistas',
            'icon'                => 'fas fa-address-card',
            'permission_group_id' => 1
        ]);

        $moduleInterviewStatuses        =  factory(Permission::class)->create([
            'name'                => 'interview_statuses',
            'display_name'        => 'Estados_entrevistas',
            'icon'                => 'fas fa-vote-yea',
            'permission_group_id' => 1
        ]);

        $moduleCamModelSocial        =  factory(Permission::class)->create([
            'name'                => 'cammodel_social',
            'display_name'        => 'Redes_modelos',
            'icon'                => 'fas fa-share-alt',
            'permission_group_id' => 9
        ]);

        $moduleCamModelStreaming        =  factory(Permission::class)->create([
            'name'                => 'cammodel_streamings',
            'display_name'        => 'Streamings_modelos',
            'icon'                => 'fas fa-satellite-dish',
            'permission_group_id' => 9
        ]);


        /*Creacion Usuario Super Admin Desarrollo*/
        $employee          =  factory(Employee::class)->create([
            'email'        => 'desarrollo@smartcommerce.com.co'
        ]);

        $super             =  factory(Role::class)->create([
            'name'         => 'superadmin',
            'display_name' => 'Super Admin',
            'status'       => 0
        ]);

        $roleSuperRepo =  new RoleRepository($super);
        $roleSuperRepo->attachToPermission($moduleEmployees);
        $roleSuperRepo->attachToPermission($moduleCities);
        $roleSuperRepo->attachToPermission($moduleSubsidiaries);
        $roleSuperRepo->attachToPermission($moduleRoles);
        $roleSuperRepo->attachToPermission($modulePermission);
        $roleSuperRepo->attachToPermission($modulePqrs);
        $roleSuperRepo->attachToPermission($modulePqrsStatuses);
        $roleSuperRepo->attachToPermission($moduleCustomers);
        $roleSuperRepo->attachToPermission($moduleCustomerStatuses);
        $roleSuperRepo->attachToPermission($moduleActions);
        $roleSuperRepo->attachToPermission($moduleProducts);
        $roleSuperRepo->attachToPermission($moduleProductCategories);
        $roleSuperRepo->attachToPermission($moduleAttributes);
        $roleSuperRepo->attachToPermission($moduleBrands);
        $roleSuperRepo->attachToPermission($moduleOrders);
        $roleSuperRepo->attachToPermission($moduleCourses);
        $roleSuperRepo->attachToPermission($moduleStudents);
        $roleSuperRepo->attachToPermission($moduleCourseAttendances);
        $roleSuperRepo->attachToPermission($moduleWishlists);
        $roleSuperRepo->attachToPermission($moduleCheckouts);
        $roleSuperRepo->attachToPermission($moduleOrderShipments);
        $roleSuperRepo->attachToPermission($moduleProductReviews);
        $roleSuperRepo->attachToPermission($moduleCamModelCategories);
        $roleSuperRepo->attachToPermission($moduleCamModels);
        $roleSuperRepo->attachToPermission($moduleNewsletterSubscriptions);
        $roleSuperRepo->attachToPermission($moduleInterviews);
        $roleSuperRepo->attachToPermission($moduleInterviewStatuses);
        $roleSuperRepo->attachToPermission($moduleCamModelSocial);
        $roleSuperRepo->attachToPermission($moduleCamModelStreaming);
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
        $roleAdminRepo->attachToPermission($moduleCustomers);
        $roleAdminRepo->attachToPermission($moduleCustomerStatuses);
        $roleAdminRepo->attachToPermission($moduleProducts);
        $roleAdminRepo->attachToPermission($moduleProductCategories);
        $roleAdminRepo->attachToPermission($moduleAttributes);
        $roleAdminRepo->attachToPermission($moduleBrands);
        $roleAdminRepo->attachToPermission($moduleOrders);
        $roleAdminRepo->attachToPermission($moduleWishlists);
        $roleAdminRepo->attachToPermission($moduleCheckouts);
        $roleAdminRepo->attachToPermission($moduleOrderShipments);
        $roleAdminRepo->attachToPermission($moduleProductReviews);
        $roleAdminRepo->attachToPermission($moduleNewsletterSubscriptions);
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
        $rolecourseadmin->attachToPermission($moduleNewsletterSubscriptions);
        $coursEemployee->roles()->save($courseadmin);


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

        /*Creacion Usuario Cam_model*/
        $camModelEmployee    =  factory(Employee::class)->create([
            'email'        => 'modelo@sycgroup.com'
        ]);

        $camModel       =  factory(Role::class)->create([
            'name'         => 'cam_model',
            'display_name' => 'CamModel'
        ]);

        $roleCamModel = new RoleRepository($camModel);
        $roleCamModel->attachToPermission($moduleCamModels);
        $camModelEmployee->roles()->save($camModel);



        /*Creacion Usuario Cam_model*/
        $CommunityEmployee    =  factory(Employee::class)->create([
            'email'        => 'community@sycgroup.com'
        ]);

        $community       =  factory(Role::class)->create([
            'name'         => 'community_manager',
            'display_name' => 'Community Manager'
        ]);

        $roleCommunity = new RoleRepository($community);
        $roleCommunity->attachToPermission($moduleCamModelSocial);
        $roleCommunity->attachToPermission($moduleCamModelStreaming);
        $CommunityEmployee->roles()->save($community);
    }
}
