<?php

namespace Modules\CallCenter\Entities\QuestionnaireCampaigns\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\CallCenter\Entities\QuestionnaireCampaigns\CallCenterQuestionnaireCampaign;
use Modules\CallCenter\Entities\QuestionnaireCampaigns\Exceptions\CreateQuestionnaireCampaignErrorException;
use Modules\CallCenter\Entities\QuestionnaireCampaigns\Exceptions\QuestionnaireCampaignNotFoundException;
use Modules\CallCenter\Entities\QuestionnaireCampaigns\Exceptions\UpdateQuestionnaireCampaignErrorException;
use Modules\CallCenter\Entities\QuestionnaireCampaigns\Repositories\Interfaces\CallCenterQuestionnaireCampaignRepositoryInterface;

class CallCenterQuestionnaireCampaignRepository implements CallCenterQuestionnaireCampaignRepositoryInterface
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

    public function __construct(CallCenterQuestionnaireCampaign $campaignRequest)
    {
        $this->model = $campaignRequest;
    }

    public function listCallCenterQuestionnaireCampaigns(int $totalView)
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

    public function searchCallCenterQuestionnaireCampaign(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (empty($text) && is_null($from) && is_null($to)) {
                return $this->listCallCenterQuestionnaireCampaigns($totalView);
            }

            if (!empty($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchCallCenterQuestionnaireCampaign($text, null, true, true)
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

            return $this->model->searchCallCenterQuestionnaireCampaign($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countCallCenterQuestionnaireCampaigns(string $text = null,  $from = null, $to = null)
    {
        if (empty($text) && is_null($from) && is_null($to)) {
            return $this->model->count('id');
        }

        if (!empty($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchCallCenterQuestionnaireCampaign($text, null, true, true)
                ->count('id');
        }

        if (empty($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->count('id');
        }

        return $this->model->searchCallCenterQuestionnaireCampaign($text, null, true, true)
            ->whereBetween('created_at', [$from, $to])
            ->count('id');
    }

    public function searchTrashedCallCenterQuestionnaireCampaign(string $text = null): Collection
    {
        if (empty($text)) {
            return $this->model->onlyTrashed($text)->get($this->columns);
        }

        return $this->model->onlyTrashed()->get($this->columns);
    }

    public function createCallCenterQuestionnaireCampaign(array $data): CallCenterQuestionnaireCampaign
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateQuestionnaireCampaignErrorException($e);
        }
    }

    public function findCallCenterQuestionnaireCampaignById(int $id): CallCenterQuestionnaireCampaign
    {
        try {
            return $this->model->findOrFail($id, $this->campaignRequestColumns);
        } catch (ModelNotFoundException $e) {
            throw new QuestionnaireCampaignNotFoundException($e);
        }
    }

    public function findTrashedCallCenterQuestionnaireCampaignById(int $id): CallCenterQuestionnaireCampaign
    {
        try {
            return $this->model->withTrashed()->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new QuestionnaireCampaignNotFoundException($e);
        }
    }

    public function updateCallCenterQuestionnaireCampaign(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            throw new UpdateQuestionnaireCampaignErrorException($e);
        }
    }

    public function deleteCallCenterQuestionnaireCampaign(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function recoverTrashedCallCenterQuestionnaireCampaign(): bool
    {
        try {
            return $this->model->restore();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
