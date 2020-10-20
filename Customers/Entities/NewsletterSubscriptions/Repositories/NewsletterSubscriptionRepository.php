<?php

namespace Modules\Customers\Entities\Customers\Repositories;

use Modules\Customers\Entities\NewsletterSubscriptions\NewsletterSubscription;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;
use Modules\Customers\Entities\NewsletterSubscriptions\Repositories\Interfaces\NewsletterSubscriptionRepositoryInterface;

class NewsletterSubscriptionRepository implements NewsletterSubscriptionRepositoryInterface
{
    protected $model;
    private $columns = [
        'email',
        'is_active',
        'created-at'
    ];

    public function __construct(NewsletterSubscription $newsletterSubscription)
    {
        $this->model = $newsletterSubscription;
    }

    public function listNewsletterSubscriptions($totalView): Support
    {
        try {
            return  $this->model->orderBy('created_at', 'asc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function createNewsletterSubscription(array $params): NewsletterSubscription
    {
        try {
            return $this->model->create($params);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function deleteNewsletterSubscription(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
