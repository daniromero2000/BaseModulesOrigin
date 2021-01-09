<?php

namespace Modules\CallCenter\Entities\CampaignRequests\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\CallCenter\Entities\CampaignRequests\CallCenterCampaignRequest;
use Modules\CallCenter\Entities\CampaignRequests\Exceptions\CreateCampaignRequestErrorException;
use Modules\CallCenter\Entities\CampaignRequests\Exceptions\CampaignRequestNotFoundException;
use Modules\CallCenter\Entities\CampaignRequests\Exceptions\UpdateCampaignRequestErrorException;
use Modules\CallCenter\Entities\CampaignRequests\Repositories\Interfaces\CallCenterCampaignRequestRepositoryInterface;
use Illuminate\Http\UploadedFile;

class CallCenterCampaignRequestRepository implements CallCenterCampaignRequestRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'employee_id',
        'campaign',
        'script',
        'description',
        'src'
    ];

    private $listColumns = [
        'id',
        'employee_id',
        'campaign',
        'status',
        'description',
        'src'
    ];

    private $campaignRequestColumns = [
        'id',
        'employee_id',
        'campaign',
        'script',
        'description',
        'src'
    ];

    public function __construct(CallCenterCampaignRequest $campaignRequest)
    {
        $this->model = $campaignRequest;
    }

    public function listCallCenterCampaignRequests(int $totalView)
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

    public function searchCallCenterCampaignRequest(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (empty($text) && is_null($from) && is_null($to)) {
                return $this->listCallCenterCampaignRequests($totalView);
            }

            if (!empty($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchCallCenterCampaignRequest($text, null, true, true)
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

            return $this->model->searchCallCenterCampaignRequest($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function saveDocumentFile(UploadedFile $file): string
    {
        return $file->store('CampaignRequest', ['disk' => 'public']);
    }


    public function countCallCenterCampaignRequests(string $text = null,  $from = null, $to = null)
    {
        if (empty($text) && is_null($from) && is_null($to)) {
            return $this->model->count('id');
        }

        if (!empty($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchCallCenterCampaignRequest($text, null, true, true)
                ->count('id');
        }

        if (empty($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->count('id');
        }

        return $this->model->searchCallCenterCampaignRequest($text, null, true, true)
            ->whereBetween('created_at', [$from, $to])
            ->count('id');
    }

    public function searchTrashedCallCenterCampaignRequest(string $text = null): Collection
    {
        if (empty($text)) {
            return $this->model->onlyTrashed($text)->get($this->columns);
        }

        return $this->model->onlyTrashed()->get($this->columns);
    }

    public function createCallCenterCampaignRequest(array $data): CallCenterCampaignRequest
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateCampaignRequestErrorException($e);
        }
    }

    public function findCallCenterCampaignRequestById(int $id): CallCenterCampaignRequest
    {
        try {
            return $this->model->findOrFail($id, $this->campaignRequestColumns);
        } catch (ModelNotFoundException $e) {
            throw new CampaignRequestNotFoundException($e);
        }
    }

    public function findTrashedCallCenterCampaignRequestById(int $id): CallCenterCampaignRequest
    {
        try {
            return $this->model->withTrashed()->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CampaignRequestNotFoundException($e);
        }
    }

    public function updateCallCenterCampaignRequest(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            throw new UpdateCampaignRequestErrorException($e);
        }
    }

    public function deleteCallCenterCampaignRequest(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function recoverTrashedCallCenterCampaignRequest(): bool
    {
        try {
            return $this->model->restore();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
