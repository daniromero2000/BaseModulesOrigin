<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Entities\Actions\Action;

class ModulesActionsTableSeeder extends Seeder
{
    public function run()
    {
        // Acciones Módulo Empleados
        factory(Action::class)->create([
            'permission_id' => 1,
            'name'          => 'Ver Empleados',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.employees.index',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 1,
            'name'      => 'Crear Empleado',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.employees.create',
            'principal' => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 1,
            'name'          => 'Editar Empleado',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.employees.edit',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 1,
            'name'          => 'Ver Empleado',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.employees.show',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 1,
            'name'          => 'Borrar Empleado',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.employees.destroy',
            'principal'     => 0
        ]);

        // Acciones Módulo Ciudades
        factory(Action::class)->create([
            'permission_id' => 2,
            'name'          => 'Ver Ciudades',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.countries.index',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 2,
            'name'          => 'Ver Ciudad',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.countries.show',
            'principal'     => 0
        ]);

        // Acciones Módulo Sucursales
        factory(Action::class)->create([
            'permission_id' => 3,
            'name'          => 'Ver Sucursales',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.subsidiaries.index',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 3,
            'name'          => 'Crear Sucursal',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.subsidiaries.create',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 3,
            'name'          => 'Editar Sucursal',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.subsidiaries.edit',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 3,
            'name'          => 'Ver Sucursal',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.subsidiaries.show',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 3,
            'name'          => 'Borrar Sucursal',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.subsidiaries.destroy',
            'principal'     => 0
        ]);

        // Acciones Módulo Roles
        factory(Action::class)->create([
            'permission_id' => 4,
            'name'          => 'Ver Roles',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.roles.index',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 4,
            'name'          => 'Crear Rol',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.roles.create',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 4,
            'name'          => 'Editar Rol',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.roles.edit',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 4,
            'name'          => 'Ver Rol',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.roles.show',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 4,
            'name'          => 'Borrar Rol',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.roles.destroy',
            'principal'     => 0
        ]);

        // Acciones Módulo Permisos
        factory(Action::class)->create([
            'permission_id' => 5,
            'name'          => 'Ver Permisos',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.permissions.index',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 5,
            'name'          => 'Crear Permisos',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.permissions.create',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 5,
            'name'          => 'Editar Permisos',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.permissions.edit',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 5,
            'name'          => 'Ver Permiso',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.permissions.show',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 5,
            'name'          => 'Borrar Permiso',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.permissions.destroy',
            'principal'     => 0
        ]);

        // Acciones Módulo PQRs
        factory(Action::class)->create([
            'permission_id' => 6,
            'name'          => 'Ver PQR´s',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.pqrsdashboard',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 6,
            'name'          => 'Crear PQR´s',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.pqrs.create',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 6,
            'name'          => 'Editar PQR´s',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.pqrs.edit',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 6,
            'name'          => 'Ver PQR´s',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.pqrs.show',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 6,
            'name'          => 'Borrar PQR´s',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.pqrs.destroy',
            'principal'     => 0
        ]);

        // Acciones Módulo PQRs
        factory(Action::class)->create([
            'permission_id' => 7,
            'name'          => 'Ver Estados PQR´s',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.pqr-statuses.index',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 7,
            'name'          => 'Crear Estado PQR',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.pqr-statuses.create',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 7,
            'name'          => 'Editar Estado PQR',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.pqr-statuses.edit',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 7,
            'name'          => 'Borrar Estado PQR',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.pqr-statuses.destroy',
            'principal'     => 0
        ]);

        // Acciones Módulo Clientes
        factory(Action::class)->create([
            'permission_id' => 8,
            'name'          => 'Ver Clientes',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.customers.index',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 8,
            'name'          => 'Crear Cliente',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.customers.create',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 8,
            'name'          => 'Editar Cliente',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.customers.edit',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 8,
            'name'          => 'Ver Cliente',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.customers.show',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 8,
            'name'          => 'Borrar Cliente',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.customers.destroy',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 9,
            'name'          => 'Ver Estados Cliente',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.customer-statuses.index',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 9,
            'name'          => 'Crear Estado Ciente',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.customer-statuses.create',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 9,
            'name'          => 'Editar Estado Cliente',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.customer-statuses.edit',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 9,
            'name'          => 'Borrar Estado Cliente',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.customer-statuses.destroy',
            'principal'     => 0
        ]);

        // Acciones Módulo Acciones
        factory(Action::class)->create([
            'permission_id' => 10,
            'name'          => 'Ver Acciones',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.actions.index',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 10,
            'name'          => 'Crear Acción',
            'icon'          => 'fas fa-plus',
            'route'         => 'admin.actions.create',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 10,
            'name'          => 'Editar Acción',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.actions.edit',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 10,
            'name'          => 'Ver Acción',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.actions.show',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 10,
            'name'          => 'Borrar Acción',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.actions.destroy',
            'principal'     => 0
        ]);

        // Acciones Módulo Productos
        factory(Action::class)->create([
            'permission_id' => 11,
            'name'          => 'Ver Productos',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.products.index',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 11,
            'name'      => 'Crear Producto',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.products.create',
            'principal' => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 11,
            'name'          => 'Editar Producto',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.products.edit',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 11,
            'name'          => 'Ver Producto',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.Products.show',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 11,
            'name'          => 'Borrar Producto',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.product.destroy',
            'principal'     => 0
        ]);

        // Acciones Módulo Categorías
        factory(Action::class)->create([
            'permission_id' => 12,
            'name'          => 'Ver Categorías',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.categories.index',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 12,
            'name'      => 'Crear Categoría',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.categories.create',
            'principal' => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 12,
            'name'          => 'Editar Categoría',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.categories.edit',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 12,
            'name'          => 'Ver Categoría',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.categories.show',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 12,
            'name'          => 'Borrar Categoría',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.categories.destroy',
            'principal'     => 0
        ]);

        // Acciones Módulo Atributos
        factory(Action::class)->create([
            'permission_id' => 13,
            'name'          => 'Ver Atributos',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.attributes.index',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 13,
            'name'      => 'Crear Atributo',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.attributes.create',
            'principal' => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 13,
            'name'          => 'Editar Atributo',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.attributes.edit',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 13,
            'name'          => 'Ver Atributo',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.attributes.show',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 13,
            'name'          => 'Borrar Atributo',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.attributes.destroy',
            'principal'     => 0
        ]);

        // Acciones Módulo Marcas
        factory(Action::class)->create([
            'permission_id' => 14,
            'name'          => 'Ver Marcas',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.brands.index',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 14,
            'name'      => 'Crear Marca',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.brands.create',
            'principal' => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 14,
            'name'          => 'Editar Marca',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.brands.edit',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 14,
            'name'          => 'Ver Marca',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.brands.show',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 14,
            'name'          => 'Borrar Marca',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.brands.destroy',
            'principal'     => 0
        ]);

        // Acciones Módulo Ordenes
        factory(Action::class)->create([
            'permission_id' => 15,
            'name'          => 'Ver Ordenes',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.orders.index',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 15,
            'name'          => 'Editar Orden',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.orders.edit',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 15,
            'name'          => 'Ver Orden',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.orders.show',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 15,
            'name'          => 'Borrar Orden',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.orders.destroy',
            'principal'     => 0
        ]);

        // Acciones Módulo cursos
        factory(Action::class)->create([
            'permission_id' => 16,
            'name'          => 'Ver Cursos',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.courses.index',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 16,
            'name'      => 'Crear Curso',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.courses.create',
            'principal' => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 16,
            'name'          => 'Editar Curso',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.courses.edit',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 16,
            'name'          => 'Ver Curso',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.courses.show',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 16,
            'name'          => 'Borrar Curso',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.courses.destroy',
            'principal'     => 0
        ]);

        // Acciones Módulo estudiantes
        factory(Action::class)->create([
            'permission_id' => 17,
            'name'          => 'Ver Estudiantes',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.students.index',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 17,
            'name'      => 'Crear Estudiante',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.students.create',
            'principal' => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 17,
            'name'          => 'Editar Estudiante',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.students.edit',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 17,
            'name'          => 'Ver Estudiante',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.students.show',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 17,
            'name'          => 'Borrar Estudiante',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.students.destroy',
            'principal'     => 0
        ]);

        // Acciones Módulo Asistencias Cursos
        factory(Action::class)->create([
            'permission_id' => 18,
            'name'          => 'Ver Asistencias',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.course_attendances.index',
            'principal'     => 1
        ]);

        // Acciones Módulo wishlists
        factory(Action::class)->create([
            'permission_id' => 19,
            'name'          => 'Ver Wishlists',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.wishlists.index',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 19,
            'name'          => 'Ver Wishlist',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.wishlists.show',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 20,
            'name'          => 'Borrar Wishlist',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.wishlists.destroy',
            'principal'     => 0
        ]);

        // Acciones Módulo Checkouts
        factory(Action::class)->create([
            'permission_id' => 20,
            'name'          => 'Ver Checkouts',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.checkouts.index',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 20,
            'name'          => 'Ver Checkout',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.checkouts.show',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 20,
            'name'          => 'Borrar Checkout',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.checkouts.destroy',
            'principal'     => 0
        ]);

        // Acciones Módulo despacho de ordenes
        factory(Action::class)->create([
            'permission_id' => 21,
            'name'          => 'Ver Despachos',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.order-shipments.index',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 21,
            'name'          => 'Editar Despacho',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.order-shipments.edit',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 21,
            'name'          => 'Ver Despacho',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.order-shipments.show',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 21,
            'name'          => 'Borrar Despacho',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.order-shipments.destroy',
            'principal'     => 0
        ]);

        // Acciones Módulo calificacion de producto
        factory(Action::class)->create([
            'permission_id' => 22,
            'name'          => 'Ver Calificaciones',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.product-reviews.index',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 22,
            'name'          => 'Ver Calificacion',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.product-reviews.show',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 22,
            'name'          => 'Borrar Calificacion',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.product-reviews.destroy',
            'principal'     => 0
        ]);

        // Acciones Módulo Categorias modelos
        factory(Action::class)->create([
            'permission_id' => 23,
            'name'          => 'Ver Categorías Modelos',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.cammodel-categories.index',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 23,
            'name'      => 'Crear Categoría Modelo',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.cammodel-categories.create',
            'principal' => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 23,
            'name'          => 'Editar Categoría Modelo',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.cammodel-categories.edit',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 23,
            'name'          => 'Ver Categoría Modelo',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.cammodel-categories.show',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 23,
            'name'          => 'Borrar Categoría Modelo',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.cammodel-categories.destroy',
            'principal'     => 0
        ]);

        // Acciones Módulo modelos
        factory(Action::class)->create([
            'permission_id' => 24,
            'name'          => 'Ver Modelos',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.cammodels.index',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 24,
            'name'      => 'Crear Modelo',
            'icon'      => 'fas fa-plus',
            'route'     => 'admin.cammodels.create',
            'principal' => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 24,
            'name'          => 'Editar Modelo',
            'icon'          => 'fas fa-edit',
            'route'         => 'admin.cammodels.edit',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 24,
            'name'          => 'Ver Modelo',
            'icon'          => 'fas fa-search',
            'route'         => 'admin.cammodels.show',
            'principal'     => 0
        ]);

        factory(Action::class)->create([
            'permission_id' => 24,
            'name'          => 'Borrar Modelo',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.cammodels.destroy',
            'principal'     => 0
        ]);

        // Acciones Módulo Newsletters Subscriptions
        factory(Action::class)->create([
            'permission_id' => 25,
            'name'          => 'Ver Subscripciones',
            'icon'          => 'fas fa-eye',
            'route'         => 'admin.newsletter-subscription.index',
            'principal'     => 1
        ]);

        factory(Action::class)->create([
            'permission_id' => 25,
            'name'          => 'Borrar Subscripción',
            'icon'          => 'fas fa-times',
            'route'         => 'admin.newsletter-subscription.destroy',
            'principal'     => 0
        ]);
    }
}
