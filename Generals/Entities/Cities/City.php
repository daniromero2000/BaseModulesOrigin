<?php

namespace Modules\Generals\Entities\Cities;

use Modules\Generals\Entities\Provinces\Province;
use Modules\Companies\Entities\Subsidiaries\Subsidiary;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\CustomerAddresses\CustomerAddress;
use Modules\Customers\Entities\CustomerEconomicActivities\CustomerEconomicActivity;
use Modules\Customers\Entities\CustomerIdentities\CustomerIdentity;
use Modules\Customers\Entities\Customers\Customer;

class City extends Model
{
    use SoftDeletes;
    protected $table = 'cities';

    protected $fillable = [
        'name',
        'province_id'
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [];

    protected $guarded = [
        'id',
        'created_at',
        'deleted_at',
        'status',
        'updated_at',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class)
            ->select(['id', 'dane', 'province', 'country_id', 'is_active']);
    }

    public function subsidiaries()
    {
        return $this->hasMany(Subsidiary::class)
            ->select(['id', 'name', 'address', 'phone', 'opening_hours', 'city_id', 'company_id', 'is_active']);;
    }

    public function customers()
    {
        return $this->hasMany(Customer::class)
            ->select([
                'id', 'customer_group_id', 'name', 'last_name', 'birthday', 'scholarity_id', 'status', 'customer_status_id', 'customer_channel_id', 'city_id',
                'data_politics', 'genre_id', 'customer_channel_id', 'civil_status_id', 'scholarity_id', 'email', 'created_at'
            ]);
    }

    public function customerAddresses()
    {
        return $this->hasMany(CustomerAddress::class)
            ->select(['id', 'housing_id', 'customer_address', 'time_living', 'stratum_id', 'city_id', 'customer_id', 'postal_code', 'comment', 'default_address']);
    }

    public function customerEconomicActivities()
    {
        return $this->hasMany(CustomerEconomicActivity::class)
            ->select(['economicActivityType', 'professionsList', 'city']);
    }

    public function customerIdentities()
    {
        return $this->hasMany(CustomerIdentity::class)
            ->select(['id', 'identity_type_id', 'identity_number', 'expedition_date', 'city_id', 'customer_id', 'status', 'created_at']);
    }
}
