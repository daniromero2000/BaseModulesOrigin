<?php

namespace Modules\CallCenter\Entities\CommentManagements\Services\Interfaces;

interface CallCenterCommentManagementServiceInterface
{
    public function listCommentManagements(array $data): array;

    public function saveCommentManagement(array $data): bool;

    public function updateCommentManagement(array $data): bool;

    public function deleteCommentManagement(int $id): bool;
}
