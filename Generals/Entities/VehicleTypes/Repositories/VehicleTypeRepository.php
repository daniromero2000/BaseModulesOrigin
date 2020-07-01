<?php

namespace Modules\Generals\Entities\VehicleTypes\Repositories;

use Modules\Generals\Entities\VehicleTypes\VehicleType;
use Modules\Generals\Entities\VehicleTypes\Repositories\Interfaces\VehicleTypeRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class VehicleTypeRepository implements VehicleTypeRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'vehicle_type'];

    public function __construct(
        VehicleType $VehicleType
    ) {
        $this->model = $VehicleType;
    }

    public function getAllVehicleTypesNames()
    {
        try {
            return $this->model->orderBy('vehicle_type', 'asc')
                ->get(['id', 'vehicle_type']);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findVehicleTypeById($id): VehicleType
    {
        try {
            return $this->model->findOrfail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }
}
