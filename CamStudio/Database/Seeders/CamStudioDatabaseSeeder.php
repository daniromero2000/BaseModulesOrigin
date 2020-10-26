<?php

namespace Modules\CamStudio\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CamStudioDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(CamModelCategoriesTableSeeder::class);
        $this->call(StreamingTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
        $this->call(CamModelActionsTableSeeder::class);
        $this->call(CommunityActionsTableSeeder::class);
    }
}
