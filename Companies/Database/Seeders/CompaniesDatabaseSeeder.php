<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CompaniesDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();
        $this->call(CompanyTableSeeder::class);
        $this->call(SubsidiaryTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(EmployeePositionsTableSeeder::class);
        $this->call(PermissionsGroupsTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
        $this->call(ModulesActionsTableSeeder::class);
        $this->call(ModuleInterviewsActionsTableSeeder::class);
        $this->call(SuperAdminActionsTableSeeder::class);
        $this->call(EcommerceOperativeActionsTableSeeder::class);
        $this->call(CoursesAdminActionsTableSeeder::class);
        $this->call(CamModelActionsTableSeeder::class);
        $this->call(DepartmentsEmployeesTableSeeder::class);
        $this->call(InterviewStatusTableSeeder::class);
    }
}
