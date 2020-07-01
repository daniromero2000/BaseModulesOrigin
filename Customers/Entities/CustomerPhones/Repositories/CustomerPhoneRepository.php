<?php

namespace Modules\Customers\Entities\CustomerPhones\Repositories;

use Modules\Customers\Entities\CustomerPhones\CustomerPhone;
use Modules\Customers\Entities\CustomerPhones\Repositories\Interfaces\CustomerPhoneRepositoryInterface;
use Illuminate\Database\QueryException;

class CustomerPhoneRepository implements CustomerPhoneRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(CustomerPhone $customerPhone)
    {
        $this->model = $customerPhone;
    }

    public function createCustomerPhone(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function checkIfExists($request)
    {
        if ($customerPhone = $this->findCustomerPhone($request)) {
            return $customerPhone;
        } else {
            return;
        }
    }

    private function findCustomerPhone($data)
    {
        try {
            if (!empty($customerPhone = $this->model->where('phone', $data)->first())) {
                return  $customerPhone;
            } else {
                return;
            }
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }
}
