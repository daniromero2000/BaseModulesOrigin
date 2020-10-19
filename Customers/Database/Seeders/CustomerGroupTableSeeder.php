<?php

namespace Modules\Customers\Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CustomerGroupTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('customer_groups')->delete();

        DB::table('customer_groups')->insert([
            [
                'id'              => 1,
                'code'            => 'guest',
                'name'            => 'Guest',
                'is_user_defined' => 0,
            ], [
                'id'              => 2,
                'code'            => 'general',
                'name'            => 'General',
                'is_user_defined' => 0
            ], [
                'id'              => 3,
                'code'            => 'wholesale',
                'name'            => 'Wholesale',
                'is_user_defined' => 0,
            ], [
                'id'              => 4,
                'code'            => 'modelo',
                'name'            => 'modelo',
                'is_user_defined' => 0,
            ],
            [
                'id'              => 5,
                'code'            => 'estudio',
                'name'            => 'estudio',
                'is_user_defined' => 0,
            ],
            [
                'id'              => 6,
                'code'            => 'satelite_estudio',
                'name'            => 'satelite_estudio',
                'is_user_defined' => 0,
            ],
            [
                'id'              => 7,
                'code'            => 'empleado',
                'name'            => 'empleado',
                'is_user_defined' => 0,
            ],
            [
                'id'              => 8,
                'code'            => 'ecommerce',
                'name'            => 'ecommerce',
                'is_user_defined' => 0,
            ]

        ]);
    }
}
