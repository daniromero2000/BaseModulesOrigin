<?php

namespace Modules\CallCenter\Entities\CampaignBases\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\CallCenter\Entities\CampaignBases\CallCenterCampaignBase;
use Modules\CallCenter\Entities\CampaignBases\Exceptions\CreateCampaignBaseErrorException;
use Modules\CallCenter\Entities\CampaignBases\Exceptions\CampaignBaseNotFoundException;
use Modules\CallCenter\Entities\CampaignBases\Exceptions\UpdateCampaignBaseErrorException;
use Modules\CallCenter\Entities\CampaignBases\Repositories\Interfaces\CallCenterCampaignBaseRepositoryInterface;

class CallCenterCampaignBaseRepository implements CallCenterCampaignBaseRepositoryInterface
{
    protected $model;
    private $columns = [
        'employee_id',
        'campaign_id',
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

    private $campaignBaseColumns = [
        'employee_id',
        'campaign',
        'script',
        'description',
        'src'
    ];

    public function __construct(CallCenterCampaignBase $campaignBase)
    {
        $this->model = $campaignBase;
    }

    public function listCallCenterCampaignBases(int $totalView)
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

    public function searchCallCenterCampaignBase(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (empty($text) && is_null($from) && is_null($to)) {
                return $this->listCallCenterCampaignBases($totalView);
            }

            if (!empty($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchCallCenterCampaignBase($text, null, true, true)
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

            return $this->model->searchCallCenterCampaignBase($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countCallCenterCampaignBases(string $text = null,  $from = null, $to = null)
    {
        if (empty($text) && is_null($from) && is_null($to)) {
            return $this->model->count('id');
        }

        if (!empty($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchCallCenterCampaignBase($text, null, true, true)
                ->count('id');
        }

        if (empty($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->count('id');
        }

        return $this->model->searchCallCenterCampaignBase($text, null, true, true)
            ->whereBetween('created_at', [$from, $to])
            ->count('id');
    }

    public function searchTrashedCallCenterCampaignBase(string $text = null): Collection
    {
        if (empty($text)) {
            return $this->model->onlyTrashed($text)->get($this->columns);
        }

        return $this->model->onlyTrashed()->get($this->columns);
    }

    public function createCallCenterCampaignBase(array $data): CallCenterCampaignBase
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateCampaignBaseErrorException($e);
        }
    }

    public function findCallCenterCampaignBaseById(int $id): CallCenterCampaignBase
    {
        try {
            return $this->model->findOrFail($id, $this->campaignBaseColumns);
        } catch (ModelNotFoundException $e) {
            throw new CampaignBaseNotFoundException($e);
        }
    }

    public function findTrashedCallCenterCampaignBaseById(int $id): CallCenterCampaignBase
    {
        try {
            return $this->model->withTrashed()->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CampaignBaseNotFoundException($e);
        }
    }

    public function updateCallCenterCampaignBase(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            throw new UpdateCampaignBaseErrorException($e);
        }
    }

    public function deleteCallCenterCampaignBase(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function destroyCallCenterCampaignBase($id): bool
    {
        try {
            return $this->model->where('campaign_id', $id)->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function recoverTrashedCallCenterCampaignBase(): bool
    {
        try {
            return $this->model->restore();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getCustomers($id, $totalView)
    {
        try {
            return $this->model->where('campaign_id', $id)
                ->where('call_center_status_id', $id)
                ->skip($totalView)->take(1)
                ->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
