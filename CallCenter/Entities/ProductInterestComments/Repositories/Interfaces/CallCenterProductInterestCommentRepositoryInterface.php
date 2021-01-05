<?php

namespace Modules\CallCenter\Entities\ProductInterestComments\Repositories\Interfaces;

use Modules\CallCenter\Entities\ProductInterestComments\CallCenterProductInterestComment;
use Illuminate\Support\Collection;

interface CallCenterProductInterestCommentRepositoryInterface
{
    public function listCallCenterProductInterestComments(int $totalView);

    public function createCallCenterProductInterestComment(array $params): CallCenterProductInterestComment;

    public function findCallCenterProductInterestCommentById(int $id): CallCenterProductInterestComment;

    public function findTrashedCallCenterProductInterestCommentById(int $id): CallCenterProductInterestComment;

    public function updateCallCenterProductInterestComment(array $params): bool;

    public function searchCallCenterProductInterestComment(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countCallCenterProductInterestComments(string $text = null,  $from = null, $to = null);

    public function searchTrashedCallCenterProductInterestComment(string $text = null): Collection;

    public function deleteCallCenterProductInterestComment(): bool;

    public function recoverTrashedCallCenterProductInterestComment(): bool;
}
