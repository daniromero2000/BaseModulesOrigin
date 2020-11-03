<?php

namespace Modules\Leads\Database\Seeders;


use Illuminate\Database\Seeder;
use Modules\Leads\Entities\LeadChannels\LeadChannel;

class LeadChannelsTableSeeder extends Seeder
{
    public function run()
    {
        factory(LeadChannel::class)->create([
            'channel' => 'Pagina Web',
        ]);

        factory(LeadChannel::class)->create([
            'channel' => 'Whatsapp',
        ]);

        factory(LeadChannel::class)->create([
            'channel' => 'Facebook',
        ]);

        factory(LeadChannel::class)->create([
            'channel' => 'Linea 01-8000',
        ]);

        factory(LeadChannel::class)->create([
            'channel' => 'Instagram',
        ]);

        factory(LeadChannel::class)->create([
            'channel' => 'Campañas Call Center',
        ]);
    }
}
