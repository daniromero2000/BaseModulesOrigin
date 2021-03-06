<?php

namespace Modules\Leads\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class LeadsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(LeadChannelsTableSeeder::class);
        $this->call(LeadProductsTableSeeder::class);
        $this->call(LeadServicesTableSeeder::class);
        $this->call(LeadStatusesTableSeeder::class);
    }
}
