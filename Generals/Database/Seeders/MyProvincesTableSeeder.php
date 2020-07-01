<?php

namespace Modules\Generals\Database\Seeders;

use Modules\Generals\Entities\Provinces\Province;
use Illuminate\Database\Seeder;

class MyProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Province::class)->create([
            'dane'        => '05',
            'province'        => 'Antioquia',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '08',
            'province'        => 'Atlántico',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '11',
            'province'        => 'Bogotá',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '13',
            'province'        => 'Bolivar',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '15',
            'province'        => 'Boyacá',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '17',
            'province'        => 'Caldas',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '18',
            'province'        => 'Caquetá',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '19',
            'province'        => 'Cauca',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '20',
            'province'        => 'Cesar',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '23',
            'province'        => 'Córdoba',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '25',
            'province'        => 'Cundinamarca',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '27',
            'province'        => 'Chocó',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '41',
            'province'        => 'Huila',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '44',
            'province'        => 'La Guajira',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '47',
            'province'        => 'Magdalena',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '50',
            'province'        => 'Meta',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '52',
            'province'        => 'Nariño',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '54',
            'province'        => 'Norte de Santander',
            'country_id' => '1',
        ]);


        factory(Province::class)->create([
            'dane'        => '63',
            'province'        => 'Quindío',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '66',
            'province'        => 'Risaralda',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '68',
            'province'        => 'Santander',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '70',
            'province'        => 'Sucre',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '73',
            'province'        => 'Tolima',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '76',
            'province'        => 'Valle del Cauca',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '81',
            'province'        => 'Arauca',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '85',
            'province'        => 'Casanare',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '86',
            'province'        => 'Putumayo',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '88',
            'province'        => 'San Andrés',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '91',
            'province'        => 'Amazonas',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '94',
            'province'        => 'Guainía',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '95',
            'province'        => 'Guaviare',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '97',
            'province'        => 'Vaupes',
            'country_id' => '1',
        ]);

        factory(Province::class)->create([
            'dane'        => '99',
            'province'        => 'Vichada',
            'country_id' => '1',
        ]);
    }
}
