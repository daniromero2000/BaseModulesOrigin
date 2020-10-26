<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Modules\CamStudio\Entities\Streamings\Streaming;

$factory->define(Streaming::class, function () {

    return [
        'streaming' => 'Chaturbate',
        'url'    => 'ww.chaturbate.com'
    ];
});
