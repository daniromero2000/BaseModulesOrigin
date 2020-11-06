<?php

namespace Modules\Courses\Entities\CourseAttendances;

use Illuminate\Database\Eloquent\Model;
use Modules\Courses\Entities\Courses\Course;
use Modules\Courses\Entities\Students\Student;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class CourseAttendance extends Model
{
    use  SearchableTrait;

    protected $table = 'course_attendances';

    protected $fillable = [
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

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'relevance',
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $searchable = [
        'columns' => [
            'course_attendances.course_name'    => 50,
            'course_attendances.identification' => 5,
            'course_attendances.name'           => 15,
            'course_attendances.position'       => 10,
            'course_attendances.phone'          => 10,
            'course_attendances.hotel_city'     => 11,
            'course_attendances.hotel_name'     => 11
        ]
    ];

    public function searchCourseAttendance($term)
    {
        return self::search($term);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
