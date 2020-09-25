<?php

namespace Modules\Courses\Entities\Students;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Modules\Courses\Entities\Students\Student;

class FirstSheetImport implements ToModel
{
    public function model(array $row)
    {


        return new Student([
            'id_type'       => $row[1],
            'identification' => $row[2],
            'name' => $row[3],
            'last_name' => $row[4],
            'hotel_name' => $row[5],
            'hotel_city' => $row[6],
            'sesion_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[7])
        ]);
    }
}
