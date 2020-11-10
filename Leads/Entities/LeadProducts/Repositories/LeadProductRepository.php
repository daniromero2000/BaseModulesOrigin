<?php

namespace Modules\Leads\Entities\LeadProducts\Repositories;

use Modules\Leads\Entities\LeadProducts\LeadProduct;
use Modules\Leads\Entities\LeadProducts\Repositories\Interfaces\LeadProductRepositoryInterface;
use Illuminate\Database\QueryException;

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
}
