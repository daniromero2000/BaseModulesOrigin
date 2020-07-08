<?php

namespace Modules\Pqrs\Entities\Pqrs;

use Modules\Pqrs\Entities\PqrCommentaries\PqrCommentary;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Pqrs\Entities\PqrsStatusesLogs\PqrsStatusesLog;
use Modules\Pqrs\Entities\PqrStatuses\PqrStatus;
use Modules\Generals\Entities\Cities\City;

class Pqr extends Authenticatable
{
    use Notifiable, SoftDeletes;
    protected $table = 'pqrs';

    protected $fillable = [
        'name',
        'cedula',
        'email',
        'pqr',
        'asunto',
        'mensaje',
        'city_id',
        'pqr_status_id',
        'lead',
        'phone',
        'data_politics'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'deleted_at',
        'updated_at',
        'cedula',
        'email',
        'asunto',
        'mensaje',
        'status_id',
        'city_id',
        'data_politics',
        'city',
        'lead',
        'pqr_city',
        'relevance',
        'status'
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'deleted_at',
        'updated_at',
        'status'
    ];

    public function pqrsCommentaries()
    {
        return $this->hasMany(PqrCommentary::class);
    }

    public function pqrsStatusesLog()
    {
        return $this->hasMany(PqrsStatusesLog::class);
    }

    public function pqrStatus()
    {
        return $this->belongsTo(PqrStatus::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class)
            ->select(['id', 'dane', 'city', 'province_id', 'is_active']);
    }
}
