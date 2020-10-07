<?php

namespace Modules\Courses\Entities\CourseAttendances\Exports;

use Carbon\Carbon;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Courses\Entities\CourseAttendances\CourseAttendance;
use PhpOffice\PhpSpreadsheet\Shared\Date;

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
        'end_date',
        'created_at'
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
            'cierre',
            'asistencia'
        ];
    }

    /**
     * @var Invoice $invoice
     */
    public function map($collection)
    {
        foreach ($collection as $key => $value) {
            $date =  $value->created_at;
            $date = (string) $date;
            unset($value->created_at);
            $value->date = (string) strval($date);
        }

        return $collection;
    }

    public function collection()
    {
        $collection = CourseAttendance::get($this->columns);


        return $this->map($collection);
    }
}
