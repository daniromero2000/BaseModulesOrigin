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

// Permiso Módulo Cursos
$rolecourseadmin->attachToPermission($moduleCourses);
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
$rolecourseadmin->attachToPermission($moduleStudents);
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
$rolecourseadmin->attachToPermission($moduleCourseAttendances);
// Permisos Acciones Módulo Cursos
factory(ActionRole::class)->create([
'action_id' => 80,
'role_id' => 1
]);


$coursEemployee->roles()->save($courseadmin);
