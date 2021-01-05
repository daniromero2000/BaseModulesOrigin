<?php

namespace Modules\CallCenter\Entities\PaymentPromises\Repositories\Interfaces;

use Modules\CallCenter\Entities\PaymentPromises\CallCenterPaymentPromise;
use Illuminate\Support\Collection;

interface CallCenterPaymentPromiseRepositoryInterface
{
    public function listCallCenterPaymentPromises(int $totalView);

    public function createCallCenterPaymentPromise(array $params): CallCenterPaymentPromise;

    public function findCallCenterPaymentPromiseById(int $id): CallCenterPaymentPromise;

    public function findTrashedCallCenterPaymentPromiseById(int $id): CallCenterPaymentPromise;

    public function updateCallCenterPaymentPromise(array $params): bool;

    public function searchCallCenterPaymentPromise(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countCallCenterPaymentPromises(string $text = null,  $from = null, $to = null);

    public function searchTrashedCallCenterPaymentPromise(string $text = null): Collection;

    public function deleteCallCenterPaymentPromise(): bool;

    public function recoverTrashedCallCenterPaymentPromise(): bool;
}
