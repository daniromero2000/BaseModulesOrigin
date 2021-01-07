<?php

namespace Modules\CallCenter\Entities\Assignments\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\CallCenter\Entities\Assignments\CallCenterAssignment;
use Modules\CallCenter\Entities\Assignments\Exceptions\CreateAssignmentErrorException;
use Modules\CallCenter\Entities\Assignments\Exceptions\AssignmentNotFoundException;
use Modules\CallCenter\Entities\Assignments\Exceptions\UpdateAssignmentErrorException;
use Modules\CallCenter\Entities\Assignments\Repositories\Interfaces\CallCenterAssignmentRepositoryInterface;

class CallCenterAssignmentRepository implements CallCenterAssignmentRepositoryInterface
{
    protected $model;
    private $columns = [
        'employee_id',
        'campaign',
        'script',
        'description',
        'src'
    ];

    private $listColumns = [
        'employee_id',
        'campaign',
        'script',
        'description',
        'src'
    ];

    private $assignmentColumns = [
        'employee_id',
        'campaign',
        'script',
        'description',
        'src'
    ];

    public function __construct(CallCenterAssignment $assignment)
    {
        $this->model = $assignment;
    }

    public function listCallCenterAssignments(int $totalView)
    {
        try {
            return  $this->model
                ->orderBy('id', 'desc')
                ->skip($totalView)->take(30)
                ->get($this->listColumns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchCallCenterAssignment(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (is_null($text) && is_null($from) && is_null($to)) {
                return $this->listCallCenterAssignments($totalView);
            }

            if (!is_null($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchCallCenterAssignment($text, null, true, true)
                    ->skip($totalView)
                    ->take(30)
                    ->get($this->columns);
            }

            if (is_null($text) && (!is_null($from) || !is_null($to))) {
                return $this->model->whereBetween('created_at', [$from, $to])
                    ->skip($totalView)
                    ->take(30)
                    ->get($this->columns);
            }

            return $this->model->searchCallCenterAssignment($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countCallCenterAssignments(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->model->count('id');
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchCallCenterAssignment($text, null, true, true)
                ->count('id');
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->count('id');
        }

        return $this->model->searchCallCenterAssignment($text, null, true, true)
            ->whereBetween('created_at', [$from, $to])
            ->count('id');
    }

    public function searchTrashedCallCenterAssignment(string $text = null): Collection
    {
        if (is_null($text)) {
            return $this->model->onlyTrashed($text)->get($this->columns);
        }

        return $this->model->onlyTrashed()->get($this->columns);
    }

    public function createCallCenterAssignment(array $data): CallCenterAssignment
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateAssignmentErrorException($e);
        }
    }

    public function findCallCenterAssignmentById(int $id): CallCenterAssignment
    {
        try {
            return $this->model->findOrFail($id, $this->assignmentColumns);
        } catch (ModelNotFoundException $e) {
            throw new AssignmentNotFoundException($e);
        }
    }

    public function findTrashedCallCenterAssignmentById(int $id): CallCenterAssignment
    {
        try {
            return $this->model->withTrashed()->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new AssignmentNotFoundException($e);
        }
    }

    public function updateCallCenterAssignment(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            throw new UpdateAssignmentErrorException($e);
        }
    }

    public function deleteCallCenterAssignment(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function recoverTrashedCallCenterAssignment(): bool
    {
        try {
            return $this->model->restore();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
