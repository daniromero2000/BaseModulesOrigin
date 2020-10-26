<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Entities\InterViewStatuses\InterviewStatus;

class InterviewStatusTableSeeder extends Seeder
{
    public function run()
    {
        factory(InterviewStatus::class)->create([
            'name' => 'Contactado',
            'color' => 'green'
        ]);

        factory(InterviewStatus::class)->create([
            'name' => 'Pendiente',
            'color' => 'yellow'
        ]);

        factory(InterviewStatus::class)->create([
            'name' => 'Rechazado',
            'color' => 'red'
        ]);

        factory(InterviewStatus::class)->create([
            'name' => 'En proceso',
            'color' => 'blue'
        ]);

        factory(InterviewStatus::class)->create([
            'name' => 'Contratado',
            'color' => 'violet'
        ]);
    }
}
