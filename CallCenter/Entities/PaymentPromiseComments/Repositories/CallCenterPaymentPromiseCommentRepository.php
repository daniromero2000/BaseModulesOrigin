<?php

namespace Modules\CallCenter\Entities\PaymentPromiseComments\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\CallCenter\Entities\PaymentPromiseComments\CallCenterPaymentPromiseComment;
use Modules\CallCenter\Entities\PaymentPromiseComments\Exceptions\CreatePaymentPromiseCommentErrorException;
use Modules\CallCenter\Entities\PaymentPromiseComments\Exceptions\PaymentPromiseCommentNotFoundException;
use Modules\CallCenter\Entities\PaymentPromiseComments\Exceptions\UpdatePaymentPromiseCommentErrorException;
use Modules\CallCenter\Entities\PaymentPromiseComments\Repositories\Interfaces\CallCenterPaymentPromiseCommentRepositoryInterface;

class CallCenterPaymentPromiseCommentRepository implements CallCenterPaymentPromiseCommentRepositoryInterface
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

    public function __construct(CallCenterPaymentPromiseComment $campaignRequest)
    {
        $this->model = $campaignRequest;
    }

    public function listCallCenterPaymentPromiseComments(int $totalView)
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

    public function searchCallCenterPaymentPromiseComment(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (is_null($text) && is_null($from) && is_null($to)) {
                return $this->listCallCenterPaymentPromiseComments($totalView);
            }

            if (!is_null($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchCallCenterPaymentPromiseComment($text, null, true, true)
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

            return $this->model->searchCallCenterPaymentPromiseComment($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countCallCenterPaymentPromiseComments(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->model->count('id');
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchCallCenterPaymentPromiseComment($text, null, true, true)
                ->count('id');
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->count('id');
        }

        return $this->model->searchCallCenterPaymentPromiseComment($text, null, true, true)
            ->whereBetween('created_at', [$from, $to])
            ->count('id');
    }

    public function searchTrashedCallCenterPaymentPromiseComment(string $text = null): Collection
    {
        if (is_null($text)) {
            return $this->model->onlyTrashed($text)->get($this->columns);
        }

        return $this->model->onlyTrashed()->get($this->columns);
    }

    public function createCallCenterPaymentPromiseComment(array $data): CallCenterPaymentPromiseComment
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreatePaymentPromiseCommentErrorException($e);
        }
    }

    public function findCallCenterPaymentPromiseCommentById(int $id): CallCenterPaymentPromiseComment
    {
        try {
            return $this->model->findOrFail($id, $this->campaignRequestColumns);
        } catch (ModelNotFoundException $e) {
            throw new PaymentPromiseCommentNotFoundException($e);
        }
    }

    public function findTrashedCallCenterPaymentPromiseCommentById(int $id): CallCenterPaymentPromiseComment
    {
        try {
            return $this->model->withTrashed()->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new PaymentPromiseCommentNotFoundException($e);
        }
    }

    public function updateCallCenterPaymentPromiseComment(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            throw new UpdatePaymentPromiseCommentErrorException($e);
        }
    }

    public function deleteCallCenterPaymentPromiseComment(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function recoverTrashedCallCenterPaymentPromiseComment(): bool
    {
        try {
            return $this->model->restore();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
