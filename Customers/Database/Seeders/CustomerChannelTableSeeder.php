<?php

namespace Modules\Customers\Database\Seeders;

use Modules\Customers\Entities\CustomerChannels\CustomerChannel;
use Illuminate\Database\Seeder;

class CustomerChannelTableSeeder extends Seeder
{
    public function run()
    {
        factory(CustomerChannel::class)->create([
            'channel'  => 'Facebook',
        ]);

        factory(CustomerChannel::class)->create([
            'channel'  => 'Whatsapp',
        ]);

        factory(CustomerChannel::class)->create([
            'channel'  => 'Telemercadeo',
        ]);

        factory(CustomerChannel::class)->create([
            'channel'  => 'Recontactado',
        ]);

        factory(CustomerChannel::class)->create([
            'channel'  => 'Almacén',
        ]);

        factory(CustomerChannel::class)->create([
            'channel'  => 'Buscado',
        ]);

        factory(CustomerChannel::class)->create([
            'channel'  => 'Adds',
        ]);

        factory(CustomerChannel::class)->create([
            'channel'  => 'Agencia',
        ]);

        factory(CustomerChannel::class)->create([
            'channel'  => 'Referencia',
        ]);

        factory(CustomerChannel::class)->create([
            'channel'  => 'Ecommerce',
        ]);
    }
}
