<?php

namespace Modules\Generals\Database\Seeders;

use Modules\Generals\Entities\VehicleTypes\VehicleType;
use Illuminate\Database\Seeder;

class VehicleTypeTableSeeder extends Seeder
{
    public function run()
    {
        factory(VehicleType::class)->create([
            'vehicle_type'  => 'Automóvil',
        ]);

        factory(VehicleType::class)->create([
            'vehicle_type'  => 'Motocicleta',
        ]);

        factory(VehicleType::class)->create([
            'vehicle_type'  => 'Avión',
        ]);

        factory(VehicleType::class)->create([
            'vehicle_type'  => 'Barco',
        ]);

        factory(VehicleType::class)->create([
            'vehicle_type'  => 'Bicicleta',
        ]);

        factory(VehicleType::class)->create([
            'vehicle_type'  => 'Bote',
        ]);

        factory(VehicleType::class)->create([
            'vehicle_type'  => 'Avioneta',
        ]);

        factory(VehicleType::class)->create([
            'vehicle_type'  => 'Submarino',
        ]);

        factory(VehicleType::class)->create([
            'vehicle_type'  => 'Camión',
        ]);

        factory(VehicleType::class)->create([
            'vehicle_type'  => 'MotoCarro',
        ]);


        factory(VehicleType::class)->create([
            'vehicle_type'  => 'Bus',
        ]);


        factory(VehicleType::class)->create([
            'vehicle_type'  => 'Buseta',
        ]);

        factory(VehicleType::class)->create([
            'vehicle_type'  => 'Taxi',
        ]);
    }
}
