<?php

namespace Modules\Pqrs\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PqrsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PqrStatusTableSeeder::class);
        Model::unguard();
    }
}
