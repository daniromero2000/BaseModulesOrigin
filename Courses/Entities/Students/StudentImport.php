<?php

namespace Modules\Courses\Entities\Student;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Modules\Courses\Entities\Students\FirstSheetImport;
use Modules\Courses\Entities\Students\SecondSheetImport;

class StudentImport implements WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            0 => new FirstSheetImport(),
            1 => new SecondSheetImport(),
        ];
    }
}
