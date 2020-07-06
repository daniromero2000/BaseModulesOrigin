<?php

namespace Modules\Generals\Entities\Stratums;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\CustomerAddresses\CustomerAddress;

class Stratum extends Model
{
    use SoftDeletes;
    protected $table = 'stratums';

    protected $fillable = [
        'stratum',
        'description'
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


    public function customerAddresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }
}
