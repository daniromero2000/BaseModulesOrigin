<?php

namespace Modules\Companies\Entities\EmployeeProfessions\Repositories;

use Modules\Companies\Entities\EmployeeProfessions\EmployeeProfession;
use Modules\Companies\Entities\EmployeeProfessions\Repositories\Interfaces\EmployeeProfessionRepositoryInterface;
use Illuminate\Database\QueryException;

class EmployeeProfessionRepository implements EmployeeProfessionRepositoryInterface
{
    public function __construct(EmployeeProfession $employeeProfession)
    {
        $this->model = $employeeProfession;
    }

    public function createEmployeeProfession(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
