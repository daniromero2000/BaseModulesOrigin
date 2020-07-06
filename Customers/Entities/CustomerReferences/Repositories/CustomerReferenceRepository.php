<?php

namespace Modules\Customers\Entities\CustomerReferences\Repositories;

use Modules\Customers\Entities\CustomerReferences\CustomerReference;
use Modules\Customers\Entities\CustomerReferences\Repositories\Interfaces\CustomerReferenceRepositoryInterface;
use Illuminate\Database\QueryException;

class CustomerReferenceRepository implements CustomerReferenceRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(
        CustomerReference $customerReference
    ) {
        $this->model = $customerReference;
    }

    public function createCustomerReference(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
