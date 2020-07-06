<?php

namespace Modules\Customers\Entities\CustomerStatuses;

use Modules\Customers\Entities\Customer\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerStatus extends Model
{
    use SoftDeletes;
    protected $table = 'customer_statuses';

    protected $fillable = [
        'status',
        'color',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'status'
    ];

    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
