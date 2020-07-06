<?php

namespace Modules\Customers\Entities\CustomerIdentities\Repositories;

use Modules\Customers\Entities\CustomerIdentities\CustomerIdentity;
use Modules\Customers\Entities\CustomerIdentities\Repositories\Interfaces\CustomerIdentityRepositoryInterface;
use Illuminate\Database\QueryException;


class CustomerIdentityRepository implements CustomerIdentityRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(
        CustomerIdentity $customerIdentity

    ) {
        $this->model = $customerIdentity;
    }

    public function createCustomerIdentity(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function checkIfExists($request)
    {
        if ($customerIdentity = $this->findCustomerIdentity($request)) {
            return $customerIdentity;
        } else {
            return;
        }
    }

    private function findCustomerIdentity($data)
    {
        try {
            if (!empty($customerIdentity = $this->model->where('identity_number', $data)->first())) {
                return  $customerIdentity;
            } else {
                return;
            }
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }
}
