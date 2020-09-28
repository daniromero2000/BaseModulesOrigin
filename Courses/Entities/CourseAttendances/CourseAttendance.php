<?php

namespace Modules\Courses\Entities\CourseAttendances;

use Illuminate\Database\Eloquent\Model;
use Modules\Courses\Entities\Courses\Course;
use Modules\Courses\Entities\Students\Student;

class CourseAttendance extends Model
{
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

        'updated_at',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
