<?php

namespace Modules\Companies\Database\Seeders;

use Modules\Companies\Entities\Permissions\Permission;
use Illuminate\Database\Seeder;

class PermissionsModulesTableSeeder extends Seeder
{
    public function run()
    {
        factory(Permission::class)->create([
            'name'                => 'employees',
            'display_name'        => 'Empleados',
            'icon'                => 'fas fa-user-tie',
            'permission_group_id' => 1
        ]);

        factory(Permission::class)->create([
            'name'                => 'countries',
            'display_name'        => 'Ciudades',
            'icon'                => 'fas fa-city',
            'permission_group_id' => 1
        ]);

        factory(Permission::class)->create([
            'name'                => 'subsidiaries',
            'display_name'        => 'Sucursales',
            'icon'                => 'fas fa-map-marker',
            'permission_group_id' => 1
        ]);

        factory(Permission::class)->create([
            'name'                => 'roles',
            'display_name'        => 'Roles',
            'icon'                => 'fas fa-user-tag',
            'permission_group_id' => 1
        ]);

        factory(Permission::class)->create([
            'name'                => 'permissions',
            'display_name'        => 'Permisos',
            'icon'                => 'fas fa-check-double',
            'permission_group_id' => 1
        ]);

        factory(Permission::class)->create([
            'name'                => 'pqrs',
            'display_name'        => 'PQR´s',
            'icon'                => 'fas fa-headset',
            'permission_group_id' => 3
        ]);

        factory(Permission::class)->create([
            'name'                => 'pqrs_statuses',
            'display_name'        => 'Estados_PQR´s',
            'icon'                => 'fas fa-headset',
            'permission_group_id' => 3
        ]);

        factory(Permission::class)->create([
            'name'                => 'customers',
            'display_name'        => 'Clientes',
            'icon'                => 'ni ni-headphones',
            'permission_group_id' => 4
        ]);

        factory(Permission::class)->create([
            'name'                => 'customer_statuses',
            'display_name'        => 'Estados_clientes',
            'icon'                => 'ni ni-favourite-28',
            'permission_group_id' => 4
        ]);

        factory(Permission::class)->create([
            'name'                => 'actions',
            'display_name'        => 'Acciones',
            'icon'                => 'fas fa-chalkboard-teacher',
            'permission_group_id' => 1
        ]);

        factory(Permission::class)->create([
            'name'                => 'products',
            'display_name'        => 'Productos',
            'icon'                => 'ni ni-shop',
            'permission_group_id' => 2
        ]);

        factory(Permission::class)->create([
            'name'                => 'product_categories',
            'display_name'        => 'Categorías_productos',
            'icon'                => 'ni ni-books',
            'permission_group_id' => 2
        ]);

        factory(Permission::class)->create([
            'name'                => 'attributes',
            'display_name'        => 'Atributos',
            'icon'                => 'fas fa-award',
            'permission_group_id' => 2
        ]);

        factory(Permission::class)->create([
            'name'                => 'brands',
            'display_name'        => 'Marcas',
            'icon'                => 'fas fa-tags',
            'permission_group_id' => 2
        ]);

        factory(Permission::class)->create([
            'name'                => 'orders',
            'display_name'        => 'Ordenes',
            'icon'                => 'fas fa-user',
            'permission_group_id' => 2
        ]);

        factory(Permission::class)->create([
            'name'                => 'courses',
            'display_name'        => 'Cursos',
            'icon'                => 'fas fa-book-reader',
            'permission_group_id' => 5
        ]);

        factory(Permission::class)->create([
            'name'                => 'students',
            'display_name'        => 'Estudiantes',
            'icon'                => 'fas fa-user-graduate',
            'permission_group_id' => 5
        ]);

        factory(Permission::class)->create([
            'name'                => 'course_attendances',
            'display_name'        => 'Asistencias',
            'icon'                => 'fas fa-user-check',
            'permission_group_id' => 5
        ]);

        factory(Permission::class)->create([
            'name'                => 'wishlist',
            'display_name'        => 'Wishlists',
            'icon'                => 'fas fa-heart',
            'permission_group_id' => 2
        ]);

        factory(Permission::class)->create([
            'name'                => 'checkouts',
            'display_name'        => 'Checkouts',
            'icon'                => 'fas fa-shopping-bag',
            'permission_group_id' => 2
        ]);

        factory(Permission::class)->create([
            'name'                => 'order_shipments',
            'display_name'        => 'Despachos',
            'icon'                => 'fas fa-share-square',
            'permission_group_id' => 2
        ]);

        //22
        factory(Permission::class)->create([
            'name'                => 'product_reviews',
            'display_name'        => 'Calificación_productos',
            'icon'                => 'fas fa-star',
            'permission_group_id' => 2
        ]);

        factory(Permission::class)->create([
            'name'                => 'libranza-quotations',
            'display_name'        => 'Cotizador_libranzas',
            'icon'                => 'ni ni-books',
            'permission_group_id' => 7
        ]);

        factory(Permission::class)->create([
            'name'                => 'leads',
            'display_name'        => 'Leads',
            'icon'                => 'fas fa-user',
            'permission_group_id' => 6
        ]);

        factory(Permission::class)->create([
            'name'                => 'newsletter_subscriptions',
            'display_name'        => 'Subscripciones',
            'icon'                => 'ni ni-single-02',
            'permission_group_id' => 4
        ]);

        // factory(Permission::class)->create([
        //     'name'                => 'interviews',
        //     'display_name'        => 'Entrevistas',
        //     'icon'                => 'fas fa-address-card',
        //     'permission_group_id' => 1
        // ]);

        // factory(Permission::class)->create([
        //     'name'                => 'interview_statuses',
        //     'display_name'        => 'Estados_entrevistas',
        //     'icon'                => 'fas fa-vote-yea',
        //     'permission_group_id' => 1
        // ]);
    }
}
