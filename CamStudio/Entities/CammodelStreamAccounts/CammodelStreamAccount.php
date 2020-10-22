<?php

namespace Modules\CamStudio\Entities\CammodelStreamAccounts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CammodelStreamAccount extends Model
{
    use SoftDeletes;

    protected $table = 'cammodel_stream_accounts';

    protected $fillable = [];

    protected $hidden = [
        'created_at',
        'deleted_at',
        'updated_at',
        'relevance',
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
}
