<?php

namespace Modules\Courses\Entities\Students;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SearchableTrait, SoftDeletes;

    protected $fillable = [
        'id_type',
        'identification',
        'name',
        'last_name',
        'position',
        'email',
        'phone',
        'hotel_name',
        'hotel_city',
        'sesion_date',
        'is_active',
    ];

    protected $hidden = [
        'created_at',
        'deleted_at',
        'updated_at',
        'relevance',
        'is_active',
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at',
        'is_active',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function searchStudent(string $term): Collection
    {
        return self::search($term)->get();
    }
}
