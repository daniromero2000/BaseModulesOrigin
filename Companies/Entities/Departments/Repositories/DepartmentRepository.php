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

    public function getAllDepartmentNames($select = ['*'])
    {
        try {
            return $this->model
                ->orderBy('name', 'desc')
                ->get($select);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findDepartmentById($id)
    {
        try {
            return $this->model->where('id', $id)->with('leadProducts', 'leadServices', 'leadStatus', 'employees')
                ->orderBy('name', 'desc')
                ->get(['id', 'name']);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
