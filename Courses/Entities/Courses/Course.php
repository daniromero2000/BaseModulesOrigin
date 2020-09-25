<?php

namespace Modules\Courses\Entities\Courses;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Courses\Entities\CourseAttendances\CourseAttendance;

class Course extends Model
{
    use SearchableTrait, SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'cover',
        'img_welcome',
        'img_footer',
        'img_button',
        'link',
        'slug',
        'is_active'
    ];

    protected $hidden = [
        'created_at',
        'deleted_at',
        'updated_at',
    ];

    protected $guarded = [
        'id',
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
            'courses.name' => 15
        ]
    ];

    public function searchCourse(string $term): Collection
    {
        return self::search($term)->get();
    }

    public function courseAttendances()
    {
        return $this->hasMany(CourseAttendance::class);
    }
}
