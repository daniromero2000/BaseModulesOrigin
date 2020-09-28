<?php

namespace Modules\Courses\Entities\CourseAttendances\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Courses\Entities\CourseAttendances\CourseAttendance;

class ExportCourseAttendances implements FromCollection, WithHeadings
{
    private $columns = [
        'course_name',
        'id_type',
        'identification',
        'name',
        'last_name',
        'position',
        'email',
        'phone',
        'hotel_name',
        'hotel_city',
        'start_date',
        'end_date'
    ];

    public function headings(): array
    {
        return [
            'Curso',
            'Tipo Documento',
            'Cedula',
            'Nombre',
            'Apellido',
            'Cargo',
            'email',
            'telefono',
            'Hotel',
            'Ciudad',
            'inicio',
            'cierre'
        ];
    }

    public function collection()
    {
        return CourseAttendance::get($this->columns);
    }
}
