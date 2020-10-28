<?php

namespace Modules\Customers\Entities\CustomerLeads\Repositories;

use Modules\Customers\Entities\CustomerLeads\CustomerLead;
use Modules\Customers\Entities\CustomerLeads\Repositories\Interfaces\CustomerLeadRepositoryInterface;
use Illuminate\Database\QueryException;


class CustomerLeadRepository implements CustomerLeadRepositoryInterface
{

    public function __construct(
        CustomerLead $customerLead
    ) {
        $this->model = $customerLead;
    }

    public function getAllCustomerLeadNames()
    {
        try {
            return $this->model->get(['id', 'lead']);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
