<?php

namespace Modules\Courses\Entities\Courses;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SearchableTrait, SoftDeletes;

    protected $fillable = [
        'name',
        'cover',
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

}
