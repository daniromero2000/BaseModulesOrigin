<?php

namespace Modules\Customers\Entities\CustomerEpss;

use Modules\Generals\Entities\Epss\Eps;
use Modules\Customers\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CustomerEps extends Model
{
    use SoftDeletes;
    protected $table = 'customer_epss';

    public $fillable = [
        'eps_id',
        'customer_id',
        'default_eps'
    ];

    protected $hidden = [
        'updated_at',
        'relevance',
        'eps_id',
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
        return $this->belongsTo(Customer::class);
    }

    public function eps()
    {
        return $this->belongsTo(Eps::class);
    }
}
