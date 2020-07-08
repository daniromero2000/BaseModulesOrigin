<?php

namespace Modules\Generals\Entities\Housings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\CustomerAddresses\CustomerAddress;

class Housing extends Model
{
    use SoftDeletes;
    protected $table = 'housings';

    protected $fillable = [
        'housing'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function customerAddresses()
    {
        return $this->hasMany(CustomerAddress::class)
            ->select(['id', 'housing_id', 'customer_address', 'time_living', 'stratum_id', 'city_id', 'customer_id', 'postal_code', 'comment', 'default_address']);
    }
}
