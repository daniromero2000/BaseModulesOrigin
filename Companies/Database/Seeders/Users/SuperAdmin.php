/*Creacion Usuario Super Admin Desarrollo*/
$employee = factory(Employee::class)->create([
'email' => 'desarrollo@smartcommerce.com.co'
]);

$super = factory(Role::class)->create([
'name' => 'superadmin',
'display_name' => 'Desarrollo'
]);

$roleSuperRepo = new RoleRepository($super);

// Permiso Módulo Empleados
$roleSuperRepo->attachToPermission($moduleEmployees);
// Permisos Acciones Módulo Empleados
factory(ActionRole::class)->create([
'action_id' => 1,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 2,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 3,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 4,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 5,
'role_id' => 1
]);

// Permiso Módulo Ciudades
$roleSuperRepo->attachToPermission($moduleCities);
// Permisos Acciones Módulo Ciudades
factory(ActionRole::class)->create([
'action_id' => 6,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 7,
'role_id' => 1
]);

// Permiso Módulo Sucursales
$roleSuperRepo->attachToPermission($moduleSubsidiaries);
// Permisos Acciones Módulo Sucursales
factory(ActionRole::class)->create([
'action_id' => 8,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 9,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 10,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 11,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 12,
'role_id' => 1
]);

// Permiso Módulo Roles
$roleSuperRepo->attachToPermission($moduleRoles);
// Permisos Acciones Módulo Roles
factory(ActionRole::class)->create([
'action_id' => 13,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 14,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 15,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 16,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 17,
'role_id' => 1
]);

// Permiso Módulo Permisos
$roleSuperRepo->attachToPermission($modulePermission);
// Permisos Acciones Módulo Permisos
factory(ActionRole::class)->create([
'action_id' => 18,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 19,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 20,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 21,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 22,
'role_id' => 1
]);

// Permiso Módulo Pqrs
$roleSuperRepo->attachToPermission($modulePqrs);
// Permisos Acciones Módulo Pqrs
factory(ActionRole::class)->create([
'action_id' => 23,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 24,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 25,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 26,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 27,
'role_id' => 1
]);

// Permiso Módulo Pqrs Statuses
$roleSuperRepo->attachToPermission($modulePqrsStatuses);
// Permisos Acciones Módulo Pqrs Statuses

factory(ActionRole::class)->create([
'action_id' => 28,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 29,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 30,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 31,
'role_id' => 1
]);


// Permiso Módulo Customers
$roleSuperRepo->attachToPermission($moduleCustomers);
// Permisos Acciones Módulo Customer
factory(ActionRole::class)->create([
'action_id' => 32,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 33,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 34,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 35,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 36,
'role_id' => 1
]);


// Permiso Módulo Customers Statuses
$roleSuperRepo->attachToPermission($moduleCustomerStatuses);
// Permisos Acciones Módulo Customer Statuses

factory(ActionRole::class)->create([
'action_id' => 37,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 38,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 39,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 40,
'role_id' => 1
]);


// Permiso Módulo Actions
$roleSuperRepo->attachToPermission($moduleActions);
// Permisos Acciones Módulo actions
factory(ActionRole::class)->create([
'action_id' => 41,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 42,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 43,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 44,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 45,
'role_id' => 1
]);


// Permiso Módulo Productos
$roleSuperRepo->attachToPermission($moduleProducts);
// Permisos Acciones Módulo Productos
factory(ActionRole::class)->create([
'action_id' => 46,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 47,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 48,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 49,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 50,
'role_id' => 1
]);


// Permiso Módulo Categorías
$roleSuperRepo->attachToPermission($moduleCategories);
// Permisos Acciones Módulo Categorías
factory(ActionRole::class)->create([
'action_id' => 51,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 52,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 53,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 54,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 55,
'role_id' => 1
]);

// Permiso Módulo marcas
$roleSuperRepo->attachToPermission($moduleAttributes);
// Permisos Acciones Módulo marcas
factory(ActionRole::class)->create([
'action_id' => 56,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 57,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 58,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 59,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 60,
'role_id' => 1
]);


// Permiso Módulo marcas
$roleSuperRepo->attachToPermission($moduleBrands);
// Permisos Acciones Módulo marcas
factory(ActionRole::class)->create([
'action_id' => 61,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 62,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 63,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 64,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 65,
'role_id' => 1
]);

// Permiso Módulo marcas
$roleSuperRepo->attachToPermission($moduleOrders);
// Permisos Acciones Módulo marcas
factory(ActionRole::class)->create([
'action_id' => 66,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 67,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 68,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 69,
'role_id' => 1
]);

// Permiso Módulo Cursos
$roleSuperRepo->attachToPermission($moduleCourses);
// Permisos Acciones Módulo Cursos
factory(ActionRole::class)->create([
'action_id' => 70,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 71,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 72,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 73,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 74,
'role_id' => 1
]);

// Permiso Módulo Cursos
$roleSuperRepo->attachToPermission($moduleStudents);
// Permisos Acciones Módulo Cursos
factory(ActionRole::class)->create([
'action_id' => 75,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 76,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 77,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 78,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 79,
'role_id' => 1
]);

// Permiso Módulo Cursos
$roleSuperRepo->attachToPermission($moduleCourseAttendances);
// Permisos Acciones Módulo Cursos
factory(ActionRole::class)->create([
'action_id' => 80,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 81,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 82,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 83,
'role_id' => 1
]);

factory(ActionRole::class)->create([
'action_id' => 84,
'role_id' => 1
]);

$employee->roles()->save($super);
