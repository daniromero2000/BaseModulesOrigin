<?php

namespace Modules\CallCenter\Entities\Assignments\Services\Interfaces;

interface CallCenterAssignmentServiceInterface
{
    public function listAssignments(array $data): array;

    public function saveAssignment(array $data): bool;

    public function updateAssignment(array $data): bool;

    public function deleteAssignment(int $id): bool;
}
