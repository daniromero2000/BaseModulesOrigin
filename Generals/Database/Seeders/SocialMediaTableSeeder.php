<?php

namespace Modules\Generals\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Generals\Entities\SocialMedias\SocialMedia;

class SocialMediaTableSeeder extends Seeder
{
    public function run()
    {
        factory(SocialMedia::class)->create([
            'social' => 'Facebook',
            'url'    => 'www.facebook.com'
        ]);

        factory(SocialMedia::class)->create([
            'social' => 'Instagram',
            'url'    => 'www.instagram.com'
        ]);

        factory(SocialMedia::class)->create([
            'social' => 'Twitter',
            'url'    => 'www.twitter.com'
        ]);

        factory(SocialMedia::class)->create([
            'social' => 'Linkedin',
            'url'    => 'www.linkedin.com'
        ]);
    }
}
