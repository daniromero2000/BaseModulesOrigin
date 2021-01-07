<?php

namespace Modules\CallCenter\Entities\Scripts\Services\Interfaces;

interface CallCenterScriptServiceInterface
{
    public function listScripts(array $data): array;

    public function saveScript(array $data): bool;

    public function updateScript(array $data): bool;

    public function deleteScript(int $id): bool;
}
