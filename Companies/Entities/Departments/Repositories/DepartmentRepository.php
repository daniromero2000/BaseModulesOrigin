<?php

namespace Modules\Companies\Entities\Departments\Repositories;

use Modules\Companies\Entities\Departments\Department;
use Modules\Companies\Entities\Departments\Repositories\Interfaces\DepartmentRepositoryInterface;
use Illuminate\Database\QueryException;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'name'];

    public function __construct(Department $department)
    {
        $this->model = $department;
    }

    public function getAllDepartmentNames()
    {
        try {
            return $this->model->orderBy('name', 'desc')->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
