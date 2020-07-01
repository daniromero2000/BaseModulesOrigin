<?php

namespace Modules\Pqrs\Entities\PqrStatuses;

use Modules\Pqrs\Entities\Pqrs\pqr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PqrStatus extends Model
{
    use SoftDeletes;
    protected $table = 'pqr_statuses';

    protected $fillable = [
        'name',
        'color',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'status'
    ];

    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at',
        'color',
        'status'
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function pqrs()
    {
        return $this->hasMany(Pqr::class);
    }
}
