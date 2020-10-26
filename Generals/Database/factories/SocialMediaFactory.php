<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Modules\Generals\Entities\SocialMedias\SocialMedia;

$factory->define(SocialMedia::class, function () {
    return [
        'social' => 'Facebook',
        'url'    => 'ww.facebook.com'
    ];
});
