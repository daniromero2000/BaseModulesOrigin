<?php

namespace Modules\CamStudio\Entities\CammodelBannedCountries;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CammodelBannedCountries extends Model
{
    use SoftDeletes;

    protected $table = 'cammodels';
    protected $fillable = [
        'cammodel_id',
        'caountry',
    ];

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
        'status'
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function cammodel()
    {
        return $this->belongsTo(Cammodel::class)
            ->select(['id', 'employee_id', 'manager_id', 'fake_age', 'nickname', 'height', 'weight', 'breast_cup_size', 'meta', 'likes_dislikes', 'about_me', 'private_show', 'my_rules']);
    }
}
