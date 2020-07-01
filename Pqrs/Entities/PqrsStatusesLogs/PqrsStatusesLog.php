<?php

namespace Modules\Pqrs\Entities\PqrsStatusesLogs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Pqrs\Entities\Pqrs\Pqr;

class PqrsStatusesLog extends Model
{
    use SoftDeletes;
    protected $table = 'pqrs_statuses_logs';

    protected $fillable = [
        'pqr_id',
        'status',
        'user',
        'time_passed'
    ];

    protected $hidden = [
        'id',
        'pqr_id',
        'updated_at',
        'relevance'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function pqr()
    {
        return $this->belongsTo(Pqr::class);
    }
}
