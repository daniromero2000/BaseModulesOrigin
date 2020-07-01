<?php

namespace Modules\Customers\Entities\CustomerStatuses\Repositories;

use Modules\Customers\Entities\CustomerStatuses\CustomerStatus;
use Modules\Customers\Entities\CustomerStatuses\Repositories\Interfaces\CustomerStatusRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class CustomerStatusRepository implements CustomerStatusRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'status', 'color'];

    public function __construct(CustomerStatus $customerStatus)
    {
        $this->model = $customerStatus;
    }

    public function createCustomerStatus(array $params)
    {
        try {
            return $this->model->create($params);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateCustomerStatus(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findCustomerStatusById(int $id): CustomerStatus
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listCustomerStatuses()
    {
        return $this->model->orderBy('status', 'asc')->get($this->columns);
    }

    public function deleteCustomerStatus(): bool
    {
        return $this->model->delete();
    }
}
