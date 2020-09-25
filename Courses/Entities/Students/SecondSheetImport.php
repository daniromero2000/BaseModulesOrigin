<?php

namespace Modules\Courses\Entities\Students;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Modules\Courses\Entities\CourseStudent\CourseStudent;

class SecondSheetImport implements ToModel
{
    public function model(array $row)
    {

        return new CourseStudent([
            'course_id'  => $row[0],
            'student_id' => $row[1],
        ]);
    }
}
