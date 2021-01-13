<?php

namespace Modules\CallCenter\Entities\Scripts\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\CallCenter\Entities\Scripts\CallCenterScript;
use Modules\CallCenter\Entities\Scripts\Exceptions\CreateScriptErrorException;
use Modules\CallCenter\Entities\Scripts\Exceptions\ScriptNotFoundException;
use Modules\CallCenter\Entities\Scripts\Exceptions\UpdateScriptErrorException;
use Modules\CallCenter\Entities\Scripts\Repositories\Interfaces\CallCenterScriptRepositoryInterface;

class CallCenterScriptRepository implements CallCenterScriptRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'script',
        'name',
        'is_active',  
    ];

    private $listColumns = [
        'id',
        'script',
        'name',   
    ];

    private $campaignRequestColumns = [
        'id',
        'script',
        'name',  
    ];

    public function __construct(CallCenterScript $campaignRequest)
    {
        $this->model = $campaignRequest;
    }

    public function listCallCenterScripts(int $totalView)
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

    public function searchCallCenterScript(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (empty($text) && is_null($from) && is_null($to)) {
                return $this->listCallCenterScripts($totalView);
            }

            if (!empty($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchCallCenterScript($text, null, true, true)
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

            return $this->model->searchCallCenterScript($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countCallCenterScripts(string $text = null,  $from = null, $to = null)
    {
        if (empty($text) && is_null($from) && is_null($to)) {
            return $this->model->count('id');
        }

        if (!empty($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchCallCenterScript($text, null, true, true)
                ->count('id');
        }

        if (empty($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->count('id');
        }

        return $this->model->searchCallCenterScript($text, null, true, true)
            ->whereBetween('created_at', [$from, $to])
            ->count('id');
    }

    public function searchTrashedCallCenterScript(string $text = null): Collection
    {
        if (empty($text)) {
            return $this->model->onlyTrashed($text)->get($this->columns);
        }

        return $this->model->onlyTrashed()->get($this->columns);
    }

    public function createCallCenterScript(array $data): CallCenterScript
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateScriptErrorException($e);
        }
    }

    public function findCallCenterScriptById(int $id): CallCenterScript
    {
        try {
            return $this->model->findOrFail($id, $this->campaignRequestColumns);
        } catch (ModelNotFoundException $e) {
            throw new ScriptNotFoundException($e);
        }
    }

    public function getAllCallCenterScript()
    {
        try {
            return  $this->model
                ->orderBy('id', 'desc')
                ->where('is_active', 1)
                ->get($this->listColumns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findTrashedCallCenterScriptById(int $id): CallCenterScript
    {
        try {
            return $this->model->withTrashed()->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new ScriptNotFoundException($e);
        }
    }

    public function updateCallCenterScript(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            throw new UpdateScriptErrorException($e);
        }
    }

    public function deleteCallCenterScript(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function recoverTrashedCallCenterScript(): bool
    {
        try {
            return $this->model->restore();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
