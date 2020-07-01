<?php

namespace Modules\Companies\Entities\EmployeeEpss\Repositories;

use Modules\Companies\Entities\EmployeeEpss\EmployeeEps;
use Modules\Companies\Entities\EmployeeEpss\Repositories\Interfaces\EmployeeEpsRepositoryInterface;
use Illuminate\Database\QueryException;

class EmployeeEpsRepository implements EmployeeEpsRepositoryInterface
{
    protected $model;

    public function __construct(EmployeeEps $employeeEps)
    {
        $this->model = $employeeEps;
    }

    public function createEmployeeEps(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
