<?php

namespace Modules\Libranza\Entities\Subscriptions\Services\Interfaces;

interface SubscriptionServiceInterface
{
    public function listSubscriptions(array $data): array;

    public function saveSubscription(array $data): bool;

    public function updateSubscription(array $data): bool;

    public function deleteSubscription(int $id): bool;

    public function updateSortOrder( $data): bool;

    public function showSubscription(int $id);

    public function listFront();
}
