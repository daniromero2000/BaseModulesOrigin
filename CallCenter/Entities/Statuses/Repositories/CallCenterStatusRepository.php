<?php

namespace Modules\CallCenter\Entities\Statuses\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\CallCenter\Entities\Statuses\CallCenterStatus;
use Modules\CallCenter\Entities\Statuses\Exceptions\CreateStatusErrorException;
use Modules\CallCenter\Entities\Statuses\Exceptions\StatusNotFoundException;
use Modules\CallCenter\Entities\Statuses\Exceptions\UpdateStatusErrorException;
use Modules\CallCenter\Entities\Statuses\Repositories\Interfaces\CallCenterStatusRepositoryInterface;

class CallCenterStatusRepository implements CallCenterStatusRepositoryInterface
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

    private $campaignRequestColumns = [
        'employee_id',
        'campaign',
        'script',
        'description',
        'src'
    ];

    public function __construct(CallCenterStatus $campaignRequest)
    {
        $this->model = $campaignRequest;
    }

    public function listCallCenterStatuses(int $totalView)
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

    public function searchCallCenterStatus(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (empty($text) && is_null($from) && is_null($to)) {
                return $this->listCallCenterStatuses($totalView);
            }

            if (!empty($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchCallCenterStatus($text, null, true, true)
                    ->skip($totalView)
                    ->take(30)
                    ->get($this->columns);
            }

            if (empty($text) && (!is_null($from) || !is_null($to))) {
                return $this->model->whereBetween('created_at', [$from, $to])
                    ->skip($totalView)
                    ->take(30)
                    ->get($this->columns);
            }

            return $this->model->searchCallCenterStatus($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countCallCenterStatuses(string $text = null,  $from = null, $to = null)
    {
        if (empty($text) && is_null($from) && is_null($to)) {
            return $this->model->count('id');
        }

        if (!empty($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchCallCenterStatus($text, null, true, true)
                ->count('id');
        }

        if (empty($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->count('id');
        }

        return $this->model->searchCallCenterStatus($text, null, true, true)
            ->whereBetween('created_at', [$from, $to])
            ->count('id');
    }

    public function searchTrashedCallCenterStatus(string $text = null): Collection
    {
        if (empty($text)) {
            return $this->model->onlyTrashed($text)->get($this->columns);
        }

        return $this->model->onlyTrashed()->get($this->columns);
    }

    public function createCallCenterStatus(array $data): CallCenterStatus
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateStatusErrorException($e);
        }
    }

    public function findCallCenterStatusById(int $id): CallCenterStatus
    {
        try {
            return $this->model->findOrFail($id, $this->campaignRequestColumns);
        } catch (ModelNotFoundException $e) {
            throw new StatusNotFoundException($e);
        }
    }

    public function findTrashedCallCenterStatusById(int $id): CallCenterStatus
    {
        try {
            return $this->model->withTrashed()->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new StatusNotFoundException($e);
        }
    }

    public function updateCallCenterStatus(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            throw new UpdateStatusErrorException($e);
        }
    }

    public function deleteCallCenterStatus(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function recoverTrashedCallCenterStatus(): bool
    {
        try {
            return $this->model->restore();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
