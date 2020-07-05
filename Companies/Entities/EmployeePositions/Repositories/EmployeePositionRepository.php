<?php

namespace Modules\Companies\Entities\EmployeePositions\Repositories;

use Modules\Companies\Entities\EmployeePositions\EmployeePosition;
use Modules\Companies\Entities\EmployeePositions\Repositories\Interfaces\EmployeePositionRepositoryInterface;
use Illuminate\Database\QueryException;
use Modules\Companies\Entities\EmployeePositions\Exceptions\CreateEmployeePositionErrorException;

class EmployeePositionRepository implements EmployeePositionRepositoryInterface
{
  protected $model;
  private $columns = ['id', 'position'];

  public function __construct(
    EmployeePosition $employeePosition
  ) {
    $this->model = $employeePosition;
  }

  public function getAllEmployeePositionNames()
  {
    try {
      return $this->model->get($this->columns);
    } catch (QueryException $e) {
      throw new CreateEmployeePositionErrorException($e);
    }
  }
}
