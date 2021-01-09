<?php

namespace Modules\CallCenter\Entities\ManagementIndicators\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\CallCenter\Entities\ManagementIndicators\CallCenterManagementIndicator;
use Modules\CallCenter\Entities\ManagementIndicators\Exceptions\CreateManagementIndicatorErrorException;
use Modules\CallCenter\Entities\ManagementIndicators\Exceptions\ManagementIndicatorNotFoundException;
use Modules\CallCenter\Entities\ManagementIndicators\Exceptions\UpdateManagementIndicatorErrorException;
use Modules\CallCenter\Entities\ManagementIndicators\Repositories\Interfaces\CallCenterManagementIndicatorRepositoryInterface;

class CallCenterManagementIndicatorRepository implements CallCenterManagementIndicatorRepositoryInterface
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

    public function __construct(CallCenterManagementIndicator $campaignRequest)
    {
        $this->model = $campaignRequest;
    }

    public function listCallCenterManagementIndicators(int $totalView)
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

    public function searchCallCenterManagementIndicator(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (empty($text) && is_null($from) && is_null($to)) {
                return $this->listCallCenterManagementIndicators($totalView);
            }

            if (!empty($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchCallCenterManagementIndicator($text, null, true, true)
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

            return $this->model->searchCallCenterManagementIndicator($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countCallCenterManagementIndicators(string $text = null,  $from = null, $to = null)
    {
        if (empty($text) && is_null($from) && is_null($to)) {
            return $this->model->count('id');
        }

        if (!empty($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchCallCenterManagementIndicator($text, null, true, true)
                ->count('id');
        }

        if (empty($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->count('id');
        }

        return $this->model->searchCallCenterManagementIndicator($text, null, true, true)
            ->whereBetween('created_at', [$from, $to])
            ->count('id');
    }

    public function searchTrashedCallCenterManagementIndicator(string $text = null): Collection
    {
        if (empty($text)) {
            return $this->model->onlyTrashed($text)->get($this->columns);
        }

        return $this->model->onlyTrashed()->get($this->columns);
    }

    public function createCallCenterManagementIndicator(array $data): CallCenterManagementIndicator
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateManagementIndicatorErrorException($e);
        }
    }

    public function findCallCenterManagementIndicatorById(int $id): CallCenterManagementIndicator
    {
        try {
            return $this->model->findOrFail($id, $this->campaignRequestColumns);
        } catch (ModelNotFoundException $e) {
            throw new ManagementIndicatorNotFoundException($e);
        }
    }

    public function findTrashedCallCenterManagementIndicatorById(int $id): CallCenterManagementIndicator
    {
        try {
            return $this->model->withTrashed()->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new ManagementIndicatorNotFoundException($e);
        }
    }

    public function updateCallCenterManagementIndicator(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            throw new UpdateManagementIndicatorErrorException($e);
        }
    }

    public function deleteCallCenterManagementIndicator(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function recoverTrashedCallCenterManagementIndicator(): bool
    {
        try {
            return $this->model->restore();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
