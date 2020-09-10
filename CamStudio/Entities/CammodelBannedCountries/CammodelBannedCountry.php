<?php

namespace Modules\CamStudio\Entities\CammodelBannedCountries;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Modules\CamStudio\Entities\Cammodels\Cammodel;
use Modules\Generals\Entities\Countries\Country;
use Nicolaslopezj\Searchable\SearchableTrait;

class CammodelBannedCountry extends Model
{
    use SearchableTrait;

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

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $searchable = [
        'columns' => [
            'cammodel_banned_countries.country_id' => 10,
            'cammodel_banned_countries.cammodel_id' => 10,
            'countries.id' => 10,
            'countries.name' => 10,
            'cammodels.id' => 10,
            'cammodels.nickname' => 10,
        ],
        'joins' => [
            'cammodels' => ['cammodels.id', 'cammodel_banned_countries.cammodel_id'],
            'countries' => ['countries.id', 'cammodel_banned_countries.country_id'],
        ],
        'groupBy' => ['cammodel_banned_countries.country_id'],
    ];

    public function cammodel()
    {
        return $this->belongsTo(Cammodel::class)->select(['id', 'nickname']);
    }

    public function country()
    {
        return $this->belongsTo(Country::class)->select(['id', 'name']);
    }

    public function searchParam(string $term): Collection
    {
        return self::search($term)->get();
    }
}
