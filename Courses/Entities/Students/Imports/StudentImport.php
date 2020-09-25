<?php

namespace Modules\Courses\Entities\Students\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Modules\Courses\Entities\Students\Imports\FirstSheetImport;
use Modules\Courses\Entities\Students\Imports\SecondSheetImport;

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
