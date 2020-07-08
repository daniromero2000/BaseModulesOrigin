<?php

namespace Modules\Generals\Entities\IdentityTypes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\CustomerIdentities\CustomerIdentity;

class IdentityType extends Model
{
    use SoftDeletes;
    protected $table = 'identity_types';

    protected $fillable = [
        'identity_type'
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

    public function customerIdentities()
    {
        return $this->hasMany(CustomerIdentity::class)
            ->select(['id', 'identity_type_id', 'identity_number', 'expedition_date', 'city_id', 'customer_id', 'status', 'created_at']);
    }
}
