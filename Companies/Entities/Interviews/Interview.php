<?php

namespace Modules\Companies\Entities\Interviews;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interview extends Model
{
    use SoftDeletes;
    protected $table = 'interviews';

    protected $fillable = [
        'subsidiary_id',
        'name',
        'last_name',
        'identification_number',
        'birthday',
        'phone',
        'email',
        'address',
        'calification',
        'employee_position_id',
        'english_knowledge',
        'facebook',
        'interview_status_id',
        'picture'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'deleted_at',
        'updated_at',
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}
