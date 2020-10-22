<?php

namespace Modules\Generals\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\CamStudio\Entities\Streamings\Streaming;


class StreamingTableSeeder extends Seeder
{
    public function run()
    {
        factory(Streaming::class)->create([
            'social' => 'Chaturbate',
            'url'    => 'www.Chaturbate.com'
        ]);
    }
}
