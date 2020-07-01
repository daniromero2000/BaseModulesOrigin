<?php

namespace Modules\Generals\Entities\VehicleBrands\Repositories;

use Modules\Generals\Entities\VehicleBrands\VehicleBrand;
use Modules\Generals\Entities\VehicleBrands\Repositories\Interfaces\VehicleBrandRepositoryInterface;
use Illuminate\Database\QueryException;

class VehicleBrandRepository implements VehicleBrandRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(
        VehicleBrand $vehicleBrand
    ) {
        $this->model = $vehicleBrand;
    }

    public function getAllVehicleBrandsNames()
    {
        try {
            return $this->model->orderBy('vehicle_brand', 'asc')
                ->get(['id', 'vehicle_brand']);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
