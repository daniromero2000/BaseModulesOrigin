<?php

namespace Modules\Courses\Entities\Student;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Modules\Courses\Entities\Students\Student;

class StudentImport implements ToModel
{
    public function model(array $row)
    {
        return new Student([
            'id_type'       => $row[0],
            'identification' => $row[1],
            'name' => $row[2],
            'last_name' => $row[3],
            'hotel_name' => $row[4],
            'hotel_city' => $row[5],
            'sesion_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[6])
        ]);
    }
}
