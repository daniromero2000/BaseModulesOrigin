<?php

namespace Modules\Leads\Entities\LeadProducts\Repositories;

use Modules\Leads\Entities\LeadProducts\LeadProduct;
use Modules\Leads\Entities\LeadProducts\Repositories\Interfaces\LeadProductRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;

class LeadProductRepository implements LeadProductRepositoryInterface
{
    public function __construct(
        LeadProduct $LeadProduct
    ) {
        $this->model = $LeadProduct;
    }

    public function getAllLeadProductNames()
    {
        try {
            return $this->model->orderBy('product', 'asc')->get(['id', 'product']);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getLeadProductForService($id)
    {
        try {
            return $this->model->where('service_id', $id)->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function createLeadProduct(array $data): LeadProduct
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findProductForName($id)
    {
        try {
            return $this->model->where('product', $id)->first();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getProductsForDepartment($id)
    {
        try {
            return $this->model->whereHas('departments', function (Builder $query) use ($id) {
                $query->where('departments.id', $id);
            })->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function syncDeparments(array $ids)
    {
        $this->model->departments()->sync($ids);
    }
}
