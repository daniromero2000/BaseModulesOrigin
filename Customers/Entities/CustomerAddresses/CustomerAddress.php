<?php

namespace Modules\Customers\Entities\CustomerAddresses;

use Modules\Customers\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Generals\Entities\Cities\City;
use Modules\Generals\Entities\Housings\Housing;
use Modules\Generals\Entities\Stratums\Stratum;

class CustomerAddress extends Model
{
    use SoftDeletes;
    protected $table = 'customer_addresses';

    public $fillable = [
        'customer_id',
        'housing_id',
        'time_living',
        'stratum_id',
        'customer_address',
        'city_id',
        'default_address'
    ];

    protected $hidden = [
        'updated_at',
        'relevance',
        'id',
        'customer_id',
        'default_address',
        'deleted_at'
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
        'updated_at'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class)->with(['province']);
    }

    public function housing()
    {
        return $this->belongsTo(Housing::class);
    }

    public function stratum()
    {
        return $this->belongsTo(Stratum::class);
    }
}
