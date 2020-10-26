<?php

namespace Modules\Generals\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Generals\Entities\Banks\Bank;

class BanksTableSeeder extends Seeder
{
    public function run()
    {
        factory(Bank::class)->create([
            'name' => 'Banco de Bogotá', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Banco Popular', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Banco CorpBanca', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Bancolombia', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Citibank', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Banco GNB Sudameris', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'BBVA Colombia', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Banco de Occidente', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Banco Caja Social', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Davivienda', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Scotiabank', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Banagrario', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'AV Villas', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Banco Credifinanciera', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Bancamía S.A.', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Banco W S.A.', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Bancoomeva', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Finandina', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Banco Falabella S.A.', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Banco Pichincha S.A.', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Banco Santander', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Banco Mundo Mujer', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Banco Multibank', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Banco Serfinanzas', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Corficolombiana', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Banca de Inversión Bancolombia', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'BNP Paribas', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Giros y Finanzas', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Tuya', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Leasing Bancoldex', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Financiera DANN Regional', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Credifamilia', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'CREZCAMOS', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'FINANCIERA JURISCOOP C.F.', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Bancoldex', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Findeter', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Financiera de Desarrollo Nacional S.A', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Finagro', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Icetex', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Fogafin', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Fondo Nacional del Ahorro', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Fogacoop', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Fondo Nacional de Garantías', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Banco de la República', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'CREDIBANCO', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'ACH Colombia S.A.', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'MOVII S.A.', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'TECNIPAGOS', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Coink S.A.', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Grupo Aval Acciones Y Valores S.A.', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Grupo De Inversiones Suramericana S.A.', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Grupo Bolívar S.A.', 'country_id' => 1, 'is_active' => 1
        ]);


        factory(Bank::class)->create([
            'name' => 'Cooperativa Médica Del Valle Y De Profesionales De Colombia Coomeva', 'country_id' => 1, 'is_active' => 1
        ]);
    }
}
