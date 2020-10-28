<?php

namespace Modules\Customers\Entities\CustomerLeads;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\Customers\Customer;

class CustomerLead extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'lead'
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
