<?php

namespace Modules\CallCenter\Entities\Scripts\Repositories\Interfaces;

use Modules\CallCenter\Entities\Scripts\CallCenterScript;
use Illuminate\Support\Collection;

interface CallCenterScriptRepositoryInterface
{
    public function listCallCenterScripts(int $totalView);

    public function createCallCenterScript(array $params): CallCenterScript;

    public function findCallCenterScriptById(int $id): CallCenterScript;

    public function findTrashedCallCenterScriptById(int $id): CallCenterScript;

    public function updateCallCenterScript(array $params): bool;

    public function getAllCallCenterScript();

    public function searchCallCenterScript(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countCallCenterScripts(string $text = null,  $from = null, $to = null);

    public function searchTrashedCallCenterScript(string $text = null): Collection;

    public function deleteCallCenterScript(): bool;

    public function recoverTrashedCallCenterScript(): bool;
}
