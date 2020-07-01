<?php

namespace Modules\Customers\Entities\CustomerChannels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\Customers\Customer;

class CustomerChannel extends Model
{
    use SoftDeletes;
    protected $table = 'customer_channels';

    protected $fillable = [
        'channel'
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

    public function customers()
    {
        $this->hasMany(Customer::class);
    }
}
