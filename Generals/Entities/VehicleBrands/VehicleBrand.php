<?php

namespace Modules\Generals\Entities\VehicleBrands;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\CustomerVehicles\CustomerVehicle;

class VehicleBrand extends Model
{
    use SoftDeletes;
    protected $table = 'vehicle_brands';

    protected $fillable = [
        'vehicle_brand'
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


    public function customerVehicles()
    {
        $this->hasMany(CustomerVehicle::class);
    }
}
