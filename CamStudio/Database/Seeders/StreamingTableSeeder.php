<?php

namespace Modules\CamStudio\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\CamStudio\Entities\Streamings\Streaming;

class StreamingTableSeeder extends Seeder
{
    public function run()
    {
        factory(Streaming::class)->create([
            'streaming' => 'Chaturbate',
            'url'    => 'www.Chaturbate.com'
        ]);

        factory(Streaming::class)->create([
            'streaming' => 'MyFreeCams',
            'url'    => 'www.MyFreeCams.com'
        ]);

        factory(Streaming::class)->create([
            'streaming' => 'Cam4',
            'url'    => 'www.Cam4.com'
        ]);

        factory(Streaming::class)->create([
            'streaming' => 'CamSoda',
            'url'    => 'www.CamSoda.com'
        ]);

        factory(Streaming::class)->create([
            'streaming' => 'BongaCams',
            'url'    => 'www.BongaCams.com'
        ]);

        factory(Streaming::class)->create([
            'streaming' => 'Naked',
            'url'    => 'www.Naked.com'
        ]);

        factory(Streaming::class)->create([
            'streaming' => 'StripChat',
            'url'    => 'www.StripChat.com'
        ]);

        factory(Streaming::class)->create([
            'streaming' => 'Streamate',
            'url'    => 'www.Streamate.com'
        ]);

        factory(Streaming::class)->create([
            'streaming' => 'LiveJasmin',
            'url'    => 'www.LiveJasmin.com'
        ]);

        factory(Streaming::class)->create([
            'streaming' => 'Camlicious',
            'url'    => 'www.Camlicious.com'
        ]);

        factory(Streaming::class)->create([
            'streaming' => 'Ufancyme',
            'url'    => 'www.Ufancyme.com'
        ]);
    }
}
