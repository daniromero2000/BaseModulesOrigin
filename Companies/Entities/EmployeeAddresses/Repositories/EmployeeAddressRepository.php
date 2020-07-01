<?php

namespace Modules\Companies\Entities\EmployeeAddresses\Repositories;

use Modules\Companies\Entities\EmployeeAddresses\EmployeeAddress;
use Modules\Companies\Entities\EmployeeAddresses\Repositories\Interfaces\EmployeeAddressRepositoryInterface;
use Illuminate\Database\QueryException;

class EmployeeAddressRepository implements EmployeeAddressRepositoryInterface
{
    protected $model;

    public function __construct(EmployeeAddress $employeeAddress)
    {
        $this->model = $employeeAddress;
    }

    public function createEmployeeAddress(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
