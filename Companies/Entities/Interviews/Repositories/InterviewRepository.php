<?php

namespace Modules\Companies\Entities\Interviews\Repositories;

use Modules\Companies\Entities\Interviews\Exceptions\InterviewInvalidArgumentException;
use Modules\Companies\Entities\Interviews\Exceptions\InterviewNotFoundException;
use Modules\Companies\Entities\Interviews\Interview;
use Modules\Companies\Entities\Interviews\Repositories\Interfaces\InterviewRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;


class InterviewRepository implements InterviewRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'name',
        'last_name',
        'identification_number',
        'birthday',
        'phone',
        'email',
        'address',
        'calification',
        'employee_position_id',
        'english_knowledge',
        'interview_status_id',
        'picture',
        'created_at'
    ];

    public function __construct(Interview $Interview)
    {
        $this->model = $Interview;
    }

    public function createInterview(array $params): Interview
    {
        try {
            return   $this->model->create($params);
        } catch (QueryException $e) {
            throw new InterviewInvalidArgumentException($e->getMessage(), 500, $e);
        }
    }

    public function updateInterview(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            throw new InterviewInvalidArgumentException($e->getMessage());
        }
    }

    public function findInterviewById(int $id): Interview
    {
        try {
            return $this->model->with(['interviewStatus', 'employeePosition', 'interviewCommentaries'])
                ->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new InterviewNotFoundException($e);
        }
    }

    public function listInterviews(int $totalView): Collection
    {
        return $this->model->with(['interviewStatus', 'employeePosition'])
            ->orderBy('id', 'desc')
            ->skip($totalView)->take(30)
            ->get($this->columns);
    }

    public function removeInterview(): bool
    {
        try {
            return $this->model
                ->where('id', $this->model->id)
                ->delete();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function searchInterview(string $text = null): Collection
    {
        if (empty($text)) {
            return $this->model->get($this->columns);
        }

        return $this->model->searchInterview($text)->get($this->columns);
    }

    public function searchTrashedInterview(string $text = null): Collection
    {
        if (empty($text)) {
            return $this->model->onlyTrashed($text)->get($this->columns);
        }

        return $this->model->onlyTrashed()->get($this->columns);
    }
}
