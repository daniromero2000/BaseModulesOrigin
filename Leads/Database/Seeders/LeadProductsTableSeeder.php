<?php

namespace Modules\Leads\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Leads\Entities\LeadProducts\LeadProduct;

class LeadProductsTableSeeder extends Seeder
{
    public function run()
    {
        factory(LeadProduct::class)->create([
            'product'  => 'Televisor',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Sonido',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Nevera',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Nevecon',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Lavadora',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Celular',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Ventilador',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Congelador',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Estufa',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Colchón',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Portátil',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Computador',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Freidora de aire',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Impresora',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Caldero',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Barra de sonido',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Parlante',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Batería',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Licuadora',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Plancha',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Plancha alisadora',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Olla a presión',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Sanduchera',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Horno Microndas',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Aire acondicionado',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Moto',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'SOAT',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Libranza',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Avance',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Garantia',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Garantia',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Autos',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Vida',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'PQRS',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Otros',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'General',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Almacenes',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Creditos',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Productos',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Devolución de Tarjeta',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Desistir',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Información',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Cupo Disponible',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Cartera',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Prestamo por Libranza',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Solicitud',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => '90 Dias - 720 Dias',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Negociación',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Cartera',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Reporte en Centrales de Riesgo',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Paz y Salvo',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Estados de Cuenta',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Demandas',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Comedor',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Hogar',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Bicicleta',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Patineta',
        ]);

        factory(LeadProduct::class)->create([
            'product'  => 'Tablet',
        ]);
    }
}
