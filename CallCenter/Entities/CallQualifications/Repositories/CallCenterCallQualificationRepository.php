<?php

namespace Modules\CallCenter\Entities\CallQualifications\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\CallCenter\Entities\CallQualifications\CallCenterCallQualification;
use Modules\CallCenter\Entities\CallQualifications\Exceptions\CreateCallQualificationErrorException;
use Modules\CallCenter\Entities\CallQualifications\Exceptions\CallQualificationNotFoundException;
use Modules\CallCenter\Entities\CallQualifications\Exceptions\UpdateCallQualificationErrorException;
use Modules\CallCenter\Entities\CallQualifications\Repositories\Interfaces\CallCenterCallQualificationRepositoryInterface;

class CallCenterCallQualificationRepository implements CallCenterCallQualificationRepositoryInterface
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

    private $callQualificationColumns = [
        'employee_id',
        'campaign',
        'script',
        'description',
        'src'
    ];

    public function __construct(CallCenterCallQualification $callQualification)
    {
        $this->model = $callQualification;
    }

    public function listCallCenterCallQualifications(int $totalView)
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

    public function searchCallCenterCallQualification(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (is_null($text) && is_null($from) && is_null($to)) {
                return $this->listCallCenterCallQualifications($totalView);
            }

            if (!is_null($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchCallCenterCallQualification($text, null, true, true)
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

            return $this->model->searchCallCenterCallQualification($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countCallCenterCallQualifications(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->model->count('id');
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchCallCenterCallQualification($text, null, true, true)
                ->count('id');
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->count('id');
        }

        return $this->model->searchCallCenterCallQualification($text, null, true, true)
            ->whereBetween('created_at', [$from, $to])
            ->count('id');
    }

    public function searchTrashedCallCenterCallQualification(string $text = null): Collection
    {
        if (is_null($text)) {
            return $this->model->onlyTrashed($text)->get($this->columns);
        }

        return $this->model->onlyTrashed()->get($this->columns);
    }

    public function createCallCenterCallQualification(array $data): CallCenterCallQualification
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateCallQualificationErrorException($e);
        }
    }

    public function findCallCenterCallQualificationById(int $id): CallCenterCallQualification
    {
        try {
            return $this->model->findOrFail($id, $this->callQualificationColumns);
        } catch (ModelNotFoundException $e) {
            throw new CallQualificationNotFoundException($e);
        }
    }

    public function findTrashedCallCenterCallQualificationById(int $id): CallCenterCallQualification
    {
        try {
            return $this->model->withTrashed()->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CallQualificationNotFoundException($e);
        }
    }

    public function updateCallCenterCallQualification(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            throw new UpdateCallQualificationErrorException($e);
        }
    }

    public function deleteCallCenterCallQualification(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function recoverTrashedCallCenterCallQualification(): bool
    {
        try {
            return $this->model->restore();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
