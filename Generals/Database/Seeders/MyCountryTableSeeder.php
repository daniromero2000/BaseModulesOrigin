<?php

namespace Modules\Generals\Database\Seeders;

use Modules\Generals\Entities\Countries\Country;
use Illuminate\Database\Seeder;

class MyCountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('countries')->insert(array(
            1 =>
            array(
                'id'         => '1',
                'iso'        => 'CO',
                'name'       => 'Colombia',
                'iso3'       => 'COL',
                'numcode'    => '170',
                'phonecode'  => '57',
                'is_active'     => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ),
        ));
    }
}
