<?php

namespace Modules\Companies\Entities\EmployeeCommentaries\Repositories;

use Modules\Companies\Entities\EmployeeCommentaries\EmployeeCommentary;
use Modules\Companies\Entities\EmployeeCommentaries\Exceptions\CreateEmployeeCommentaryErrorException;
use Modules\Companies\Entities\EmployeeCommentaries\Repositories\Interfaces\EmployeeCommentaryRepositoryInterface;
use Illuminate\Database\QueryException;

class EmployeeCommentaryRepository implements EmployeeCommentaryRepositoryInterface
{
    protected $model;

    public function __construct(EmployeeCommentary $EmployeeCommentary)
    {
        $this->model = $EmployeeCommentary;
    }

    public function createEmployeeCommentary(array $data): EmployeeCommentary
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateEmployeeCommentaryErrorException($e);
        }
    }
}
