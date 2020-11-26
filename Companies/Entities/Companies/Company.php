<?php

namespace Modules\Companies\Entities\Companies;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Entities\Departments\Department;
use Nicolaslopezj\Searchable\SearchableTrait;
use Modules\Generals\Entities\Countries\Country;

class Company extends Model
{
    use SoftDeletes, SearchableTrait;
    protected $table = 'companies';

    protected $fillable = [
        'name',
        'identification',
        'company_type',
        'description',
        'country_id',
        'logo',
        'base_currency_id',
    ];

    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'deleted_at',
        'updated_at',
        'status',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $searchable = [
        'columns' => [
            'companies.id' => 10,
            'companies.name' => 10,
            'countries.name' => 10,
        ],
        'joins' => [
            'countries' => ['countries.id', 'companies.country_id'],
        ],
    ];

    public function searchCompany($term)
    {
        return self::search($term);
    }

    public function countries()
    {
        return $this->belongsTo(Country::class)
            ->select(['id', 'name', 'is_active']);
    }

    public function deparments()
    {
        return $this->hasMany(Department::class)->with('employeePositions');
    }
}
