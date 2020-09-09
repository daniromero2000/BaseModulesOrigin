<?php

namespace Modules\CamStudio\Entities\CammodelBannedCountries;

use Illuminate\Database\Eloquent\Model;
use Modules\Generals\Entities\Countries\Country;
use Modules\CamStudio\Entities\Cammodels\Cammodel;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Support\Collection;

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
        return $this->belongsTo(Cammodel::class)->select(['id', 'nickname']);
    }

    public function country()
    {
        return $this->belongsTo(Country::class)->select(['id', 'name']);
    }
}
