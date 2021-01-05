<?php

namespace Modules\CallCenter\Entities\Assignments\Repositories\Interfaces;

use Modules\CallCenter\Entities\Assignments\CallCenterAssignment;
use Illuminate\Support\Collection;

interface CallCenterAssignmentRepositoryInterface
{
    public function listCallCenterAssignments(int $totalView);

    public function createCallCenterAssignment(array $params): CallCenterAssignment;

    public function findCallCenterAssignmentById(int $id): CallCenterAssignment;

    public function findTrashedCallCenterAssignmentById(int $id): CallCenterAssignment;

    public function updateCallCenterAssignment(array $params): bool;

    public function searchCallCenterAssignment(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countCallCenterAssignments(string $text = null,  $from = null, $to = null);

    public function searchTrashedCallCenterAssignment(string $text = null): Collection;

    public function deleteCallCenterAssignment(): bool;

    public function recoverTrashedCallCenterAssignment(): bool;
}
