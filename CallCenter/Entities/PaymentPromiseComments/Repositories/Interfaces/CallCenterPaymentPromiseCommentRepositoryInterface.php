<?php

namespace Modules\CallCenter\Entities\PaymentPromiseComments\Repositories\Interfaces;

use Modules\CallCenter\Entities\PaymentPromiseComments\CallCenterPaymentPromiseComment;
use Illuminate\Support\Collection;

interface CallCenterPaymentPromiseCommentRepositoryInterface
{
    public function listCallCenterPaymentPromiseComments(int $totalView);

    public function createCallCenterPaymentPromiseComment(array $params): CallCenterPaymentPromiseComment;

    public function findCallCenterPaymentPromiseCommentById(int $id): CallCenterPaymentPromiseComment;

    public function findTrashedCallCenterPaymentPromiseCommentById(int $id): CallCenterPaymentPromiseComment;

    public function updateCallCenterPaymentPromiseComment(array $params): bool;

    public function searchCallCenterPaymentPromiseComment(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countCallCenterPaymentPromiseComments(string $text = null,  $from = null, $to = null);

    public function searchTrashedCallCenterPaymentPromiseComment(string $text = null): Collection;

    public function deleteCallCenterPaymentPromiseComment(): bool;

    public function recoverTrashedCallCenterPaymentPromiseComment(): bool;
}
