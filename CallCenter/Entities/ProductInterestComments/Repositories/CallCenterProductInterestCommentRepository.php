<?php

namespace Modules\CallCenter\Entities\ProductInterestComments\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\CallCenter\Entities\ProductInterestComments\CallCenterProductInterestComment;
use Modules\CallCenter\Entities\ProductInterestComments\Exceptions\CreateProductInterestCommentErrorException;
use Modules\CallCenter\Entities\ProductInterestComments\Exceptions\ProductInterestCommentNotFoundException;
use Modules\CallCenter\Entities\ProductInterestComments\Exceptions\UpdateProductInterestCommentErrorException;
use Modules\CallCenter\Entities\ProductInterestComments\Repositories\Interfaces\CallCenterProductInterestCommentRepositoryInterface;

class CallCenterProductInterestCommentRepository implements CallCenterProductInterestCommentRepositoryInterface
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

    public function __construct(CallCenterProductInterestComment $campaignRequest)
    {
        $this->model = $campaignRequest;
    }

    public function listCallCenterProductInterestComments(int $totalView)
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

    public function searchCallCenterProductInterestComment(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (empty($text) && is_null($from) && is_null($to)) {
                return $this->listCallCenterProductInterestComments($totalView);
            }

            if (!empty($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchCallCenterProductInterestComment($text, null, true, true)
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

            return $this->model->searchCallCenterProductInterestComment($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countCallCenterProductInterestComments(string $text = null,  $from = null, $to = null)
    {
        if (empty($text) && is_null($from) && is_null($to)) {
            return $this->model->count('id');
        }

        if (!empty($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchCallCenterProductInterestComment($text, null, true, true)
                ->count('id');
        }

        if (empty($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->count('id');
        }

        return $this->model->searchCallCenterProductInterestComment($text, null, true, true)
            ->whereBetween('created_at', [$from, $to])
            ->count('id');
    }

    public function searchTrashedCallCenterProductInterestComment(string $text = null): Collection
    {
        if (empty($text)) {
            return $this->model->onlyTrashed($text)->get($this->columns);
        }

        return $this->model->onlyTrashed()->get($this->columns);
    }

    public function createCallCenterProductInterestComment(array $data): CallCenterProductInterestComment
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateProductInterestCommentErrorException($e);
        }
    }

    public function findCallCenterProductInterestCommentById(int $id): CallCenterProductInterestComment
    {
        try {
            return $this->model->findOrFail($id, $this->campaignRequestColumns);
        } catch (ModelNotFoundException $e) {
            throw new ProductInterestCommentNotFoundException($e);
        }
    }

    public function findTrashedCallCenterProductInterestCommentById(int $id): CallCenterProductInterestComment
    {
        try {
            return $this->model->withTrashed()->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new ProductInterestCommentNotFoundException($e);
        }
    }

    public function updateCallCenterProductInterestComment(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            throw new UpdateProductInterestCommentErrorException($e);
        }
    }

    public function deleteCallCenterProductInterestComment(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function recoverTrashedCallCenterProductInterestComment(): bool
    {
        try {
            return $this->model->restore();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
