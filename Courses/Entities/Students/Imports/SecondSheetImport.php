<?php

namespace Modules\Courses\Entities\Students\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\Courses\Entities\CourseStudent\CourseStudent;

class SecondSheetImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {

        return new CourseStudent([
            'course_id'  => $row['curso'],
            'student_id' => $row['estudiante'],
        ]);
    }
}
