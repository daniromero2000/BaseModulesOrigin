<?php

namespace Modules\Ecommerce\Entities\Couriers\Repositories;

use Modules\Ecommerce\Entities\Couriers\Courier;
use Modules\Ecommerce\Entities\Couriers\Exceptions\CourierInvalidArgumentException;
use Modules\Ecommerce\Entities\Couriers\Exceptions\CourierNotFoundException;
use Modules\Ecommerce\Entities\Couriers\Repositories\Interfaces\CourierRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

class CourierRepository implements CourierRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'name',
        'description',
        'url',
        'is_free',
        'cost',
        'logo',
    ];

    public function __construct(Courier $courier)
    {
        $this->model = $courier;
    }

    public function createCourier(array $params): Courier
    {
        try {
            return $this->model->create($params);
        } catch (QueryException $e) {
            throw new CourierInvalidArgumentException($e->getMessage());
        }
    }

    public function updateCourier(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            throw new CourierInvalidArgumentException($e->getMessage());
        }
    }

    public function findCourierById(int $id): Courier
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CourierNotFoundException('Courier not found.');
        }
    }

    public function listCouriers(string $order = 'id', string $sort = 'desc'): Collection
    {
        return $this->model->all($this->columns, $order, $sort);
    }

    public function deleteCourier()
    {
        return $this->model->delete();
    }
}
