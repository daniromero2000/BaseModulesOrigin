<?php

namespace Modules\CallCenter\Entities\PaymentPromiseComments\Services\Interfaces;

interface CallCenterPaymentPromiseCommentServiceInterface
{
    public function listPaymentPromiseComments(array $data): array;

    public function savePaymentPromiseComment(array $data): bool;

    public function updatePaymentPromiseComment(array $data): bool;

    public function deletePaymentPromiseComment(int $id): bool;
}
