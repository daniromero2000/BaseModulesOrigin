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
        return $this->belongsTo(Province::class);
    }

    public function subsidiaries()
    {
        return $this->hasMany(Subsidiary::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function customerAddresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }

    public function customerEconomicActivities()
    {
        return $this->hasMany(CustomerEconomicActivity::class);
    }

    public function customerIdentities()
    {
        return $this->hasMany(CustomerIdentity::class);
    }
}
