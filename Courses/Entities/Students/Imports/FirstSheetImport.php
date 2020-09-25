<?php

namespace Modules\Courses\Entities\Students\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\Courses\Entities\Students\Student;

class FirstSheetImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Student([
            'id_type'        => $row['tipo_documento'],
            'identification' => $row['documento'],
            'name'           => $row['nombres'],
            'last_name'      => $row['apellidos'],
            'position'       => $row['cargo'],
            'email'          => $row['email'],
            'phone'          => $row['telefono'],
            'hotel_name'     => $row['hotel'],
            'hotel_city'     => $row['ciudad'],
            'sesion_date'    => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['sesion'])
        ]);
    }
}
