<?php

namespace Modules\Companies\Database\Seeders;

use Modules\Companies\Entities\Permissions\Permission;
use Illuminate\Database\Seeder;

class PermissionsModulesTableSeeder extends Seeder
{
    public function run()
    {
        factory(Permission::class)->create([
            //1
            'name'                => 'employees',
            'display_name'        => 'Empleados',
            'icon'                => 'fas fa-user-tie',
            'permission_group_id' => 1
        ]);

        factory(Permission::class)->create([ 
            //2
            'name'                => 'countries',
            'display_name'        => 'Ciudades',
            'icon'                => 'fas fa-city',
            'permission_group_id' => 1
        ]);

        factory(Permission::class)->create([
            //3
            'name'                => 'subsidiaries',
            'display_name'        => 'Sucursales',
            'icon'                => 'fas fa-map-marker',
            'permission_group_id' => 1
        ]);

        factory(Permission::class)->create([
            //4
            'name'                => 'roles',
            'display_name'        => 'Roles',
            'icon'                => 'fas fa-user-tag',
            'permission_group_id' => 1
        ]);

        factory(Permission::class)->create([
            //5
            'name'                => 'permissions',
            'display_name'        => 'Permisos',
            'icon'                => 'fas fa-check-double',
            'permission_group_id' => 1
        ]);

        factory(Permission::class)->create([
            //6
            'name'                => 'pqrs',
            'display_name'        => 'PQR´s',
            'icon'                => 'fas fa-headset',
            'permission_group_id' => 3
        ]);

        factory(Permission::class)->create([
            //7
            'name'                => 'pqrs_statuses',
            'display_name'        => 'Estados_PQR´s',
            'icon'                => 'fas fa-headset',
            'permission_group_id' => 3
        ]);

        factory(Permission::class)->create([
            //8
            'name'                => 'customers',
            'display_name'        => 'Clientes',
            'icon'                => 'ni ni-headphones',
            'permission_group_id' => 4
        ]);

        factory(Permission::class)->create([
            //9
            'name'                => 'customer_statuses',
            'display_name'        => 'Estados clientes',
            'icon'                => 'ni ni-favourite-28',
            'permission_group_id' => 4
        ]);

        factory(Permission::class)->create([
            //10
            'name'                => 'actions',
            'display_name'        => 'Acciones',
            'icon'                => 'fas fa-chalkboard-teacher',
            'permission_group_id' => 1
        ]);

        factory(Permission::class)->create([
            //11
            'name'                => 'courses',
            'display_name'        => 'Cursos',
            'icon'                => 'fas fa-book-reader',
            'permission_group_id' => 5
        ]);

        factory(Permission::class)->create([
            //12
            'name'                => 'students',
            'display_name'        => 'Estudiantes',
            'icon'                => 'fas fa-user-graduate',
            'permission_group_id' => 5
        ]);

        factory(Permission::class)->create([
            //13
            'name'                => 'course_attendances',
            'display_name'        => 'Asistencias',
            'icon'                => 'fas fa-user-check',
            'permission_group_id' => 5
        ]);
       
        factory(Permission::class)->create([
            //14
            'name'                => 'leads',
            'display_name'        => 'Leads',
            'icon'                => 'fas fa-user',
            'permission_group_id' => 6
        ]);

        factory(Permission::class)->create([
            //15
            'name'                => 'documents',
            'display_name'        => 'Documentos',
            'icon'                => 'fas fa-book-reader',
            'permission_group_id' => 1
        ]);

        factory(Permission::class)->create([
            //16
            'name'                => 'documents_category',
            'display_name'        => 'Categorias de Documentos',
            'icon'                => 'fas fa-headset',
            'permission_group_id' => 1
        ]);

        factory(Permission::class)->create([
            //17
            'name'                => 'convenios',
            'display_name'        => 'Convenios',
            'icon'                => 'fas fa-headset',
            'permission_group_id' => 1
        ]);
    }
}
