<?php
namespace Modules\Pqrs\Database\Seeders;

use Modules\Pqrs\Entities\PqrStatuses\PqrStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PqrStatusTableSeeder extends Seeder
{
    public function run()
    {
        factory(PqrStatus::class)->create([
            'name'  => 'Atendido',
            'color' => 'green'
        ]);

        factory(PqrStatus::class)->create([
            'name'  => 'En Tramite',
            'color' => 'yellow'
        ]);

        factory(PqrStatus::class)->create([
            'name'  => 'Abierto',
            'color' => 'red'
        ]);

        factory(PqrStatus::class)->create([
            'name'  => 'En Trámite Pendiente Información Tercero',
            'color' => 'grey'
        ]);
    }
}
