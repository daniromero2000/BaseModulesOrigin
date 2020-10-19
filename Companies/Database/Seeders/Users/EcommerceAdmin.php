/*Creacion Usuario Administracion Ecommerce*/
$employee2 = factory(Employee::class)->create([
'email' => 'gerencia@fvn.com.co'
]);

$admin = factory(Role::class)->create([
'name' => 'admin',
'display_name' => 'Administrador'
]);

$roleAdminRepo = new RoleRepository($admin);

// Permiso Módulo Empleados
$roleAdminRepo->attachToPermission($moduleEmployees);
// Permisos Acciones Módulo Empleados
factory(ActionRole::class)->create([
'action_id' => 1,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 2,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 3,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 4,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 5,
'role_id' => 2
]);

// Permiso Módulo Ciudades
$roleAdminRepo->attachToPermission($moduleCities);
// Permisos Acciones Módulo Ciudades
factory(ActionRole::class)->create([
'action_id' => 6,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 7,
'role_id' => 2
]);

// Permiso Módulo Sucursales
$roleAdminRepo->attachToPermission($moduleSubsidiaries);
// Permisos Acciones Módulo Sucursales
factory(ActionRole::class)->create([
'action_id' => 8,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 9,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 10,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 11,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 12,
'role_id' => 2
]);


// Permiso Módulo Customers
$roleAdminRepo->attachToPermission($moduleCustomers);
// Permisos Acciones Módulo Customer
factory(ActionRole::class)->create([
'action_id' => 32,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 33,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 34,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 35,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 36,
'role_id' => 2
]);


// Permiso Módulo Customers Statuses
$roleAdminRepo->attachToPermission($moduleCustomerStatuses);
// Permisos Acciones Módulo Customer Statuses

factory(ActionRole::class)->create([
'action_id' => 37,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 38,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 39,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 40,
'role_id' => 2
]);


// Permiso Módulo Productos
$roleAdminRepo->attachToPermission($moduleProducts);
// Permisos Acciones Módulo Productos
factory(ActionRole::class)->create([
'action_id' => 46,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 47,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 48,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 49,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 50,
'role_id' => 2
]);


// Permiso Módulo Categorías
$roleAdminRepo->attachToPermission($moduleCategories);
// Permisos Acciones Módulo Categorías
factory(ActionRole::class)->create([
'action_id' => 51,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 52,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 53,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 54,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 55,
'role_id' => 2
]);

// Permiso Módulo marcas
$roleAdminRepo->attachToPermission($moduleAttributes);
// Permisos Acciones Módulo marcas
factory(ActionRole::class)->create([
'action_id' => 56,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 57,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 58,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 59,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 60,
'role_id' => 2
]);


// Permiso Módulo marcas
$roleAdminRepo->attachToPermission($moduleBrands);
// Permisos Acciones Módulo marcas
factory(ActionRole::class)->create([
'action_id' => 61,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 62,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 63,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 64,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 65,
'role_id' => 2
]);

// Permiso Módulo marcas
$roleAdminRepo->attachToPermission($moduleOrders);
// Permisos Acciones Módulo marcas
factory(ActionRole::class)->create([
'action_id' => 66,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 67,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 68,
'role_id' => 2
]);

factory(ActionRole::class)->create([
'action_id' => 69,
'role_id' => 2
]);

$employee2->roles()->save($admin);