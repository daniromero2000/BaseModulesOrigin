<?php

namespace Modules\CallCenter\Entities\CommentManagements\Repositories\Interfaces;

use Modules\CallCenter\Entities\CommentManagements\CallCenterCommentManagement;
use Illuminate\Support\Collection;

interface CallCenterCommentManagementRepositoryInterface
{
    public function listCallCenterCommentManagements(int $totalView);

    public function createCallCenterCommentManagement(array $params): CallCenterCommentManagement;

    public function findCallCenterCommentManagementById(int $id): CallCenterCommentManagement;

    public function findTrashedCallCenterCommentManagementById(int $id): CallCenterCommentManagement;

    public function updateCallCenterCommentManagement(array $params): bool;

    public function searchCallCenterCommentManagement(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countCallCenterCommentManagements(string $text = null,  $from = null, $to = null);

    public function searchTrashedCallCenterCommentManagement(string $text = null): Collection;

    public function deleteCallCenterCommentManagement(): bool;

    public function recoverTrashedCallCenterCommentManagement(): bool;
}
