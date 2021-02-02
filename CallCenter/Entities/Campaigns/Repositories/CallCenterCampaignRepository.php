<?php

namespace Modules\CallCenter\Entities\Campaigns\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\CallCenter\Entities\Campaigns\CallCenterCampaign;
use Modules\CallCenter\Entities\Campaigns\Exceptions\CreateCampaignErrorException;
use Modules\CallCenter\Entities\Campaigns\Exceptions\CampaignNotFoundException;
use Modules\CallCenter\Entities\Campaigns\Exceptions\UpdateCampaignErrorException;
use Modules\CallCenter\Entities\Campaigns\Repositories\Interfaces\CallCenterCampaignRepositoryInterface;
use Illuminate\Http\UploadedFile;

class CallCenterCampaignRepository implements CallCenterCampaignRepositoryInterface
{
    protected $model;

    private $columns = [
        'id',
        'name',
        'department_id',
        'script_id',
        'questionnary_id',
        'description',
        'begindate',
        'endingdate',
    ];

    private $listColumns = [
        'id',
        'name',
        'department_id',
        'script_id',
        'questionnary_id',
        'begindate',
        'endingdate',
    ];

    private $campaignColumns = [
        'id',
        'name',
        'department_id',
        'script_id',
        'questionnary_id',
        'description',
        'begindate',
        'endingdate',
    ];

    public function __construct(CallCenterCampaign $campaign)
    {
        $this->model = $campaign;
    }

    public function listCallCenterCampaigns(int $totalView)
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

    public function searchCallCenterCampaign(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (empty($text) && is_null($from) && is_null($to)) {
                return $this->listCallCenterCampaigns($totalView);
            }

            if (!empty($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchCallCenterCampaign($text, null, true, true)
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

            return $this->model->searchCallCenterCampaign($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countCallCenterCampaigns(string $text = null,  $from = null, $to = null)
    {
        if (empty($text) && is_null($from) && is_null($to)) {
            return $this->model->count('id');
        }

        if (!empty($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchCallCenterCampaign($text, null, true, true)
                ->count('id');
        }

        if (empty($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->count('id');
        }

        return $this->model->searchCallCenterCampaign($text, null, true, true)
            ->whereBetween('created_at', [$from, $to])
            ->count('id');
    }

    public function saveDocumentFile(UploadedFile $file): string
    {
        return $file->store('Campaign', ['disk' => 'public']);
    }

    public function searchTrashedCallCenterCampaign(string $text = null): Collection
    {
        if (empty($text)) {
            return $this->model->onlyTrashed($text)->get($this->columns);
        }

        return $this->model->onlyTrashed()->get($this->columns);
    }

    public function createCallCenterCampaign(array $data): CallCenterCampaign
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateCampaignErrorException($e);
        }
    }

    public function findCallCenterCampaignById(int $id): CallCenterCampaign
    {
        try {
            return $this->model->findOrFail($id, $this->campaignColumns);
        } catch (ModelNotFoundException $e) {
            throw new CampaignNotFoundException($e);
        }
    }

    public function findTrashedCallCenterCampaignById(int $id): CallCenterCampaign
    {
        try {
            return $this->model->withTrashed()->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CampaignNotFoundException($e);
        }
    }

    public function updateCallCenterCampaign(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            throw new UpdateCampaignErrorException($e);
        }
    }

    public function deleteCallCenterCampaign(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function recoverTrashedCallCenterCampaign(): bool
    {
        try {
            return $this->model->restore();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
