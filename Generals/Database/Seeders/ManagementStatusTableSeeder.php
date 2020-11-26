<?php

namespace Modules\Generals\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Generals\Entities\ManagementStatuses\ManagementStatus;

class ManagementStatusTableSeeder extends Seeder
{
    public function run()
    {
        factory(ManagementStatus::class)->create([
            'status'  => 'Asesoría Inadecuada',
            'type_management_status' => '0'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Calamidad doméstica',
            'type_management_status' => '0'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Cliente desiste de la solicitud',
            'type_management_status' => '0'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Cliente indica que más adelante realizará el proceso de crédito',
            'type_management_status' => '0'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Cliente indica que no cuenta con la cuota inicial',
            'type_management_status' => '0'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Cliente indica que pasará al almacén',
            'type_management_status' => '0'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Cliente no completó los datos para el crédito',
            'type_management_status' => '0'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Crédito aprobado y facturado',
            'type_management_status' => '0'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Crédito aprobado, pendiente facturación',
            'type_management_status' => '0'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Crédito negado',
            'type_management_status' => '0'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'En negociación',
            'type_management_status' => '0'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Inconveniente con garantía',
            'type_management_status' => '0'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Pendiente por gestionar',
            'type_management_status' => '0'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Promesa de pago',
            'type_management_status' => '0'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Se le envía cotización, pero no da respuesta',
            'type_management_status' => '0'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Solicita certificado de deuda',
            'type_management_status' => '0'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Solicita estado de crédito',
            'type_management_status' => '0'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Solicita estado de cuenta',
            'type_management_status' => '0'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Solicita paz y salvo',
            'type_management_status' => '0'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Solicita requisitos para crédito',
            'type_management_status' => '0'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Solicita servicio de garantía',
            'type_management_status' => '0'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Vive fuera del País',
            'type_management_status' => '0'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Celular no Corresponde',
            'type_management_status' => '1'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Cliente informa que ya realizo el pago',
            'type_management_status' => '1'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Colgó llamada pero se deja buzón de voz',
            'type_management_status' => '1'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Compromiso de pago con Ejecutivo de Campo',
            'type_management_status' => '1'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Con mora superior a 30 días',
            'type_management_status' => '1'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Cumplió con acuerdo de pago',
            'type_management_status' => '1'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'No debe cuotas atrasadas',
            'type_management_status' => '1'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'No posee cartera pendiente según crédito y libranza',
            'type_management_status' => '1'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Pendiente por anular cuota de manejo',
            'type_management_status' => '1'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Saldo inferior 10.000',
            'type_management_status' => '1'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Se encuentra al día y tiene los comprobantes',
            'type_management_status' => '1'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Se informó que debe cancelar el día',
            'type_management_status' => '1'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Solicitar Refinanciación',
            'type_management_status' => '1'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Solicitar Visita',
            'type_management_status' => '1'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Solicitar corrida de fecha',
            'type_management_status' => '1'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Teléfono fuera de servicio',
            'type_management_status' => '1'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Tiene hábito de pago para el día',
            'type_management_status' => '1'
        ]);

        factory(ManagementStatus::class)->create([
            'status'  => 'Ultima cuota saldo inferior $10.000',
            'type_management_status' => '1'
        ]);
    }
}
