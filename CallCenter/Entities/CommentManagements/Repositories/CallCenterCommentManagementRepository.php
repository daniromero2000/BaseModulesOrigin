<?php

namespace Modules\CallCenter\Entities\CommentManagements\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\CallCenter\Entities\CommentManagements\CallCenterCommentManagement;
use Modules\CallCenter\Entities\CommentManagements\Exceptions\CreateCommentManagementErrorException;
use Modules\CallCenter\Entities\CommentManagements\Exceptions\CommentManagementNotFoundException;
use Modules\CallCenter\Entities\CommentManagements\Exceptions\UpdateCommentManagementErrorException;
use Modules\CallCenter\Entities\CommentManagements\Repositories\Interfaces\CallCenterCommentManagementRepositoryInterface;

class CallCenterCommentManagementRepository implements CallCenterCommentManagementRepositoryInterface
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

    public function __construct(CallCenterCommentManagement $campaignRequest)
    {
        $this->model = $campaignRequest;
    }

    public function listCallCenterCommentManagements(int $totalView)
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

    public function searchCallCenterCommentManagement(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (is_null($text) && is_null($from) && is_null($to)) {
                return $this->listCallCenterCommentManagements($totalView);
            }

            if (!is_null($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchCallCenterCommentManagement($text, null, true, true)
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

            return $this->model->searchCallCenterCommentManagement($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countCallCenterCommentManagements(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->model->count('id');
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchCallCenterCommentManagement($text, null, true, true)
                ->count('id');
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->count('id');
        }

        return $this->model->searchCallCenterCommentManagement($text, null, true, true)
            ->whereBetween('created_at', [$from, $to])
            ->count('id');
    }

    public function searchTrashedCallCenterCommentManagement(string $text = null): Collection
    {
        if (is_null($text)) {
            return $this->model->onlyTrashed($text)->get($this->columns);
        }

        return $this->model->onlyTrashed()->get($this->columns);
    }

    public function createCallCenterCommentManagement(array $data): CallCenterCommentManagement
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateCommentManagementErrorException($e);
        }
    }

    public function findCallCenterCommentManagementById(int $id): CallCenterCommentManagement
    {
        try {
            return $this->model->findOrFail($id, $this->campaignRequestColumns);
        } catch (ModelNotFoundException $e) {
            throw new CommentManagementNotFoundException($e);
        }
    }

    public function findTrashedCallCenterCommentManagementById(int $id): CallCenterCommentManagement
    {
        try {
            return $this->model->withTrashed()->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CommentManagementNotFoundException($e);
        }
    }

    public function updateCallCenterCommentManagement(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            throw new UpdateCommentManagementErrorException($e);
        }
    }

    public function deleteCallCenterCommentManagement(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function recoverTrashedCallCenterCommentManagement(): bool
    {
        try {
            return $this->model->restore();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
