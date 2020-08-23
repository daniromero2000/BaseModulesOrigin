<?php

/**
                         * This file is part of Laratrust,
         * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Laratrust
 */

use Modules\Companies\Entities\Employees\Employee;
use Modules\Companies\Entities\Permissions\Permission;
use Modules\Companies\Entities\Roles\Role;
use Modules\Companies\Entities\Teams\Team;

return [

    'user_models' => [
        'users' => Employee::class,
    ],


    'models' => [
        /**
         * Role model
         */
        'role' => Role::class,

        /**
         * Permission model
         */
        'permission' => Permission::class,

        /**
         * Team model
         */
        'team' => Team::class,

    ],


];
