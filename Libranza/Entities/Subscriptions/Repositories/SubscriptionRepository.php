<?php

namespace Modules\Libranza\Entities\Subscriptions\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\Libranza\Entities\Subscriptions\Subscription;
use Modules\Generals\Entities\Tools\UploadableTrait;
use Modules\Libranza\Entities\Subscriptions\Repositories\Interfaces\SubscriptionRepositoryInterface;

class SubscriptionRepository implements SubscriptionRepositoryInterface
{
    use UploadableTrait;

    protected $model;
    private $columns = [
        'id',
        'name',
        'last_name',
        'email',
        'telephone',
        'post_id'
    ];

    private $listColumns = [
        'id',
        'name',
        'last_name',
        'email',
        'telephone',
        'post_id'
    ];

    private $campaignRequestColumns = [
        'id',
        'name',
        'last_name',
        'email',
        'telephone',
        'post_id'
    ];

    public function __construct(Subscription $campaignRequest)
    {
        $this->model = $campaignRequest;
    }

    public function listSubscriptions(int $totalView)
    {
        try {
            return  $this->model
                ->orderBy('created_at', 'desc')
                ->skip($totalView)->take(30)
                ->get($this->listColumns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listSubscriptionsForFront()
    {
        try {
            return  $this->model
                ->orderBy('created_at', 'desc')
                ->get($this->listColumns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchSubscription(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (empty($text) && is_null($from) && is_null($to)) {
                return $this->listSubscriptions($totalView);
            }

            if (!empty($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchSubscription($text, null, true, true)
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

            return $this->model->searchSubscription($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countSubscriptions(string $text = null,  $from = null, $to = null)
    {
        if (empty($text) && is_null($from) && is_null($to)) {
            return $this->model->count('id');
        }

        if (!empty($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchSubscription($text, null, true, true)
                ->count('id');
        }

        if (empty($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->count('id');
        }

        return $this->model->searchSubscription($text, null, true, true)
            ->whereBetween('created_at', [$from, $to])
            ->count('id');
    }

    public function searchTrashedSubscription(string $text = null): Collection
    {
        if (empty($text)) {
            return $this->model->onlyTrashed($text)->get($this->columns);
        }

        return $this->model->onlyTrashed()->get($this->columns);
    }

    public function createSubscription(array $data): Subscription
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            // throw new CreateManagementErrorException($e);
        }
    }

    public function findSubscriptionById(int $id): Subscription
    {
        try {
            return $this->model->findOrFail($id, $this->campaignRequestColumns);
        } catch (ModelNotFoundException $e) {
            // throw new ManagementNotFoundException($e);
        }
    }

    public function findTrashedSubscriptionById(int $id): Subscription
    {
        try {
            return $this->model->withTrashed()->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            // throw new ManagementNotFoundException($e);
        }
    }

    public function updateSubscription(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            // throw new UpdateManagementErrorException($e);
        }
    }

    public function saveImage($params): string
    {

        return $this->uploadOne($params['image'], 'banners', 'public', str_slug($params['name']));
    }

    public function deleteSubscription(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function recoverTrashedSubscription(): bool
    {
        try {
            return $this->model->restore();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateSortOrder(array $data)
    {
        return $this->model->where('id', $data['id'])->update($data);
    }
}
