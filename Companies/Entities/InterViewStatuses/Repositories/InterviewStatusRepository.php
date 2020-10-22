<?php

namespace Modules\Companies\Entities\InterviewStatuses\Repositories;

use Modules\Companies\Entities\InterviewStatuses\Exceptions\InterviewStatusInvalidArgumentException;
use Modules\Companies\Entities\InterviewStatuses\Exceptions\InterviewStatusNotFoundException;
use Modules\Companies\Entities\InterviewStatuses\InterviewStatus;
use Modules\Companies\Entities\InterviewStatuses\Repositories\Interfaces\InterviewStatusRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

class InterviewStatusRepository implements InterviewStatusRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'name', 'color', 'is_active'];

    public function __construct(InterviewStatus $InterviewStatus)
    {
        $this->model = $InterviewStatus;
    }

    public function createInterviewStatus(array $params): InterviewStatus
    {
        try {
            return $this->model->create($params);
        } catch (QueryException $e) {
            throw new InterviewStatusInvalidArgumentException($e->getMessage());
        }
    }

    public function updateInterviewStatus(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new InterviewStatusInvalidArgumentException($e->getMessage());
        }
    }

    public function findInterviewStatusById(int $id): InterviewStatus
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new InterviewStatusNotFoundException('Order status not found.');
        }
    }

    public function listInterviewStatuses()
    {
        return $this->model->all($this->columns);
    }

    public function deleteInterviewStatus(): bool
    {
        return $this->model->delete();
    }

    public function findOrders(): Collection
    {
        return $this->model->orders()->get();
    }

    public function findByName(string $name)
    {
        return $this->model->where('name', $name)->first();
    }
}
