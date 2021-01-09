<?php

namespace Modules\CallCenter\Entities\PaymentPromises\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\CallCenter\Entities\PaymentPromises\CallCenterPaymentPromise;
use Modules\CallCenter\Entities\PaymentPromises\Exceptions\CreatePaymentPromiseErrorException;
use Modules\CallCenter\Entities\PaymentPromises\Exceptions\PaymentPromiseNotFoundException;
use Modules\CallCenter\Entities\PaymentPromises\Exceptions\UpdatePaymentPromiseErrorException;
use Modules\CallCenter\Entities\PaymentPromises\Repositories\Interfaces\CallCenterPaymentPromiseRepositoryInterface;

class CallCenterPaymentPromiseRepository implements CallCenterPaymentPromiseRepositoryInterface
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

    public function __construct(CallCenterPaymentPromise $campaignRequest)
    {
        $this->model = $campaignRequest;
    }

    public function listCallCenterPaymentPromises(int $totalView)
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

    public function searchCallCenterPaymentPromise(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (empty($text) && is_null($from) && is_null($to)) {
                return $this->listCallCenterPaymentPromises($totalView);
            }

            if (!empty($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchCallCenterPaymentPromise($text, null, true, true)
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

            return $this->model->searchCallCenterPaymentPromise($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countCallCenterPaymentPromises(string $text = null,  $from = null, $to = null)
    {
        if (empty($text) && is_null($from) && is_null($to)) {
            return $this->model->count('id');
        }

        if (!empty($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchCallCenterPaymentPromise($text, null, true, true)
                ->count('id');
        }

        if (empty($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->count('id');
        }

        return $this->model->searchCallCenterPaymentPromise($text, null, true, true)
            ->whereBetween('created_at', [$from, $to])
            ->count('id');
    }

    public function searchTrashedCallCenterPaymentPromise(string $text = null): Collection
    {
        if (empty($text)) {
            return $this->model->onlyTrashed($text)->get($this->columns);
        }

        return $this->model->onlyTrashed()->get($this->columns);
    }

    public function createCallCenterPaymentPromise(array $data): CallCenterPaymentPromise
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreatePaymentPromiseErrorException($e);
        }
    }

    public function findCallCenterPaymentPromiseById(int $id): CallCenterPaymentPromise
    {
        try {
            return $this->model->findOrFail($id, $this->campaignRequestColumns);
        } catch (ModelNotFoundException $e) {
            throw new PaymentPromiseNotFoundException($e);
        }
    }

    public function findTrashedCallCenterPaymentPromiseById(int $id): CallCenterPaymentPromise
    {
        try {
            return $this->model->withTrashed()->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new PaymentPromiseNotFoundException($e);
        }
    }

    public function updateCallCenterPaymentPromise(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            throw new UpdatePaymentPromiseErrorException($e);
        }
    }

    public function deleteCallCenterPaymentPromise(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function recoverTrashedCallCenterPaymentPromise(): bool
    {
        try {
            return $this->model->restore();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
