<?php

namespace Modules\CallCenter\Entities\PaymentPromises\Services\Interfaces;

interface CallCenterPaymentPromiseServiceInterface
{
    public function listPaymentPromises(array $data): array;

    public function savePaymentPromise(array $data): bool;

    public function updatePaymentPromise(array $data): bool;

    public function deletePaymentPromise(int $id): bool;
}
