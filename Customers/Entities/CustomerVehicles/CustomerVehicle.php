<?php

namespace Modules\Customers\Entities\CustomerVehicles;

use Modules\Customers\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Generals\Entities\VehicleBrands\VehicleBrand;
use Modules\Generals\Entities\VehicleTypes\VehicleType;

class CustomerVehicle extends Model
{
    use SoftDeletes;
    protected $table = 'customer_vehicles';

    public $fillable = [
        'vehicle_type_id',
        'vehicle_brand_id',
        'customer_id',
        'status'
    ];

    protected $hidden = [
        'updated_at',
        'vehicle_type_id',
        'vehicle_brand_id',
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
        return $this->belongsTo(Customer::class);
    }

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class);
    }

    public function vehicleBrand()
    {
        return $this->belongsTo(VehicleBrand::class);
    }
}
