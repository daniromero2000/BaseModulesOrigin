<?php

namespace Modules\CamStudio\Entities\CammodelBannedCountries;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class CammodelBannedCountry extends Model
{
    //use SoftDeletes;

    protected $table = 'cammodel_banned_countries';
    protected $fillable = [
        'country_id',
        'cammodel_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'relevance',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $dates  = [
        'created_at',
        'updated_at',
    ];

    public function cammodel()
    {
        return $this->belongsTo(Cammodel::class)
            ->select([
                'id', 
                'employee_id', 
                'manager_id', 
                'fake_age', 
                'nickname', 
                'height', 
                'weight', 
                'breast_cup_size', 
                'meta', 
                'likes_dislikes', 
                'about_me', 
                'private_show', 
                'my_rules'
            ]);
    }
}
