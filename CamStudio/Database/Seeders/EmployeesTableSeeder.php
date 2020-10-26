<?php

namespace Modules\CamStudio\Database\Seeders;

use Modules\Companies\Entities\Employees\Employee;
use Modules\Companies\Entities\Roles\Repositories\RoleRepository;
use Modules\Companies\Entities\Roles\Role;
use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    public function run()
    {
        /*Creacion Usuario Cam_model*/
        $camModelEmployee    =  factory(Employee::class)->create([
            'email'        => 'modelo@sycgroup.com'
        ]);

        $camModel       =  factory(Role::class)->create([
            'name'         => 'cam_model',
            'display_name' => 'CamModel',
            'status'       => 0
        ]);

        $moduleCamModels = ['24'];

        $roleCamModel = new RoleRepository($camModel);
        $roleCamModel->syncPermissions($moduleCamModels);
        $camModelEmployee->roles()->save($camModel);


        /*Creacion Usuario Community Manager*/
        $CommunityEmployee    =  factory(Employee::class)->create([
            'email'        => 'community@sycgroup.com'
        ]);

        $community       =  factory(Role::class)->create([
            'name'         => 'community_manager',
            'display_name' => 'Community Manager',
            'status'       => 0
        ]);

        $moduleCamModelCommunity = ['28', '29'];

        $roleCommunity = new RoleRepository($community);
        $roleCommunity->syncPermissions($moduleCamModelCommunity);
        $CommunityEmployee->roles()->save($community);
    }
}
