<?php

namespace Modules\Courses\Entities\CourseStudent;

use Illuminate\Database\Eloquent\Model;

class CourseStudent extends Model
{
    protected $table = 'course_student';

    protected $fillable = [
        'course_id',
        'student_id'
    ];
}
