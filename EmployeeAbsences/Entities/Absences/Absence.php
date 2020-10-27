<?php

namespace Modules\Companies\Entities\Absences;

use Laratrust\Models\LaratrustAbsence;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Absence extends LaratrustAbsence
{
    use SoftDeletes, SearchableTrait;

    protected $table = 'absences';

    protected $fillable = [
        'commentary',
        'constancy',
        'start_date',
        'finish_date',
        'state',
        'employee_id',
        'boss_id',
        'reason_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'relevance',
        'deleted_at'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'deleted_at',
        'updated_at',
        'status'
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    protected $searchable = [
        'columns' => [
            'absences.employee_id' => 10,
        ],
    ];

    // public function searchAbsence($term)
    // {
    //     return self::search($term);
    // }

    // public function role()
    // {
    //     return $this->belongsToMany(Role::class, 'Absence_role', 'Absence_id', 'role_id');
    // }
}
