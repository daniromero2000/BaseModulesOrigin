<?php

namespace Modules\Customers\Entities\CustomerEmails\Repositories;

use Modules\Customers\Entities\CustomerEmails\CustomerEmail;
use Modules\Customers\Entities\CustomerEmails\Repositories\Interfaces\CustomerEmailRepositoryInterface;
use Illuminate\Database\QueryException;


class CustomerEmailRepository implements CustomerEmailRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(CustomerEmail $customerEmail)
    {
        $this->model = $customerEmail;
    }

    public function createCustomerEmail(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
