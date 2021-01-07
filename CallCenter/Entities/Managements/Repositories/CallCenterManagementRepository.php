<?php

namespace Modules\CallCenter\Entities\Managements\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\CallCenter\Entities\Managements\CallCenterManagement;
use Modules\CallCenter\Entities\Managements\Exceptions\CreateManagementErrorException;
use Modules\CallCenter\Entities\Managements\Exceptions\ManagementNotFoundException;
use Modules\CallCenter\Entities\Managements\Exceptions\UpdateManagementErrorException;
use Modules\CallCenter\Entities\Managements\Repositories\Interfaces\CallCenterManagementRepositoryInterface;

class CallCenterManagementRepository implements CallCenterManagementRepositoryInterface
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

    public function __construct(CallCenterManagement $campaignRequest)
    {
        $this->model = $campaignRequest;
    }

    public function listCallCenterManagements(int $totalView)
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

    public function searchCallCenterManagement(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (is_null($text) && is_null($from) && is_null($to)) {
                return $this->listCallCenterManagements($totalView);
            }

            if (!is_null($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchCallCenterManagement($text, null, true, true)
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

            return $this->model->searchCallCenterManagement($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countCallCenterManagements(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->model->count('id');
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchCallCenterManagement($text, null, true, true)
                ->count('id');
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->count('id');
        }

        return $this->model->searchCallCenterManagement($text, null, true, true)
            ->whereBetween('created_at', [$from, $to])
            ->count('id');
    }

    public function searchTrashedCallCenterManagement(string $text = null): Collection
    {
        if (is_null($text)) {
            return $this->model->onlyTrashed($text)->get($this->columns);
        }

        return $this->model->onlyTrashed()->get($this->columns);
    }

    public function createCallCenterManagement(array $data): CallCenterManagement
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateManagementErrorException($e);
        }
    }

    public function findCallCenterManagementById(int $id): CallCenterManagement
    {
        try {
            return $this->model->findOrFail($id, $this->campaignRequestColumns);
        } catch (ModelNotFoundException $e) {
            throw new ManagementNotFoundException($e);
        }
    }

    public function findTrashedCallCenterManagementById(int $id): CallCenterManagement
    {
        try {
            return $this->model->withTrashed()->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new ManagementNotFoundException($e);
        }
    }

    public function updateCallCenterManagement(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            throw new UpdateManagementErrorException($e);
        }
    }

    public function deleteCallCenterManagement(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function recoverTrashedCallCenterManagement(): bool
    {
        try {
            return $this->model->restore();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
