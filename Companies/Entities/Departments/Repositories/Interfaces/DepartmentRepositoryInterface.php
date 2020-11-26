<?php

namespace Modules\Companies\Entities\Departments\Repositories\Interfaces;

use Modules\Companies\Entities\Departments\Department;

interface DepartmentRepositoryInterface
{
    public function getAllDepartmentNames($select = ['*']);

    public function geDepartmentNamesForCompany($select = ['*']);

    public function findDepartmentById($id);
}
