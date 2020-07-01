<?php

namespace Modules\Companies\Entities\EmployeePhones\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Companies\Entities\EmployeePhones\EmployeePhone;
use Modules\Companies\Entities\EmployeePhones\Repositories\Interfaces\EmployeePhoneRepositoryInterface;
use Illuminate\Database\QueryException;


class EmployeePhoneRepository implements EmployeePhoneRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'phone_type', 'phone', 'employee_id', 'status', 'created_at'];

    public function __construct(
        EmployeePhone $employeePhone
    ) {
        $this->model = $employeePhone;
    }

    public function createEmployeePhone(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function checkIfExists($request)
    {
        if ($EmployeePhone = $this->findEmployeePhone($request, $this->columns)) {
            return $EmployeePhone;
        } else {
            return;
        }
    }

    private function findEmployeePhone($data)
    {
        try {
            if (!empty($employeePhone = $this->model->where('phone', $data)->first())) {
                return  $employeePhone;
            } else {
                return;
            }
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }
}
