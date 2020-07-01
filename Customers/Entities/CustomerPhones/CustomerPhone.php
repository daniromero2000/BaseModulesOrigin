<?php

namespace Modules\Customers\Entities\CustomerPhones;

use Modules\Customers\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\CustomerReferences\CustomerReference;

class CustomerPhone extends Model
{
    use SoftDeletes;
    protected $table = 'customer_phones';

    public $fillable = [
        'phone_type',
        'phone',
        'customer_id',
        'default_phone'
    ];

    protected $hidden = [
        'updated_at',
        'relevance',
        'id',
        'customer_id',
        'status',
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
        return $this->belongsTo(Customer::class)->with('scholarity');
    }

    public function customerReferences()
    {
        return $this->hasMany(CustomerReference::class);
    }
}
