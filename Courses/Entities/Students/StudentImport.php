<?php

namespace Modules\Courses\Entities\Student;

use Maatwebsite\Excel\Concerns\ToModel;
use Modules\Courses\Entities\Students\Student;

class StudentImport implements ToModel
{
    public function model(array $row)
    {
        return new Student([
            'id_type'       => $row['Tipo de identificación'] ?? $row['Tipo de identificacion'] ?? null,
            'identification' => $row['No. Cédula'] ?? null
        ]);
    }
}
