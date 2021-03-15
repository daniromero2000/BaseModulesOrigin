<?php

namespace Modules\Libranza\Entities\Subscriptions\Repositories\Interfaces;

use Modules\Libranza\Entities\Subscriptions\Subscription;
use Illuminate\Support\Collection;

interface SubscriptionRepositoryInterface
{
    public function listSubscriptions(int $totalView);

    public function listSubscriptionsForFront();

    public function createSubscription(array $params): Subscription;

    public function findSubscriptionById(int $id): Subscription;

    public function findTrashedSubscriptionById(int $id): Subscription;

    public function updateSubscription(array $params): bool;

    public function saveImage($params): string;

    public function searchSubscription(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countSubscriptions(string $text = null,  $from = null, $to = null);

    public function searchTrashedSubscription(string $text = null): Collection;

    public function deleteSubscription(): bool;

    public function updateSortOrder(array $data);

    public function recoverTrashedSubscription(): bool;
}
