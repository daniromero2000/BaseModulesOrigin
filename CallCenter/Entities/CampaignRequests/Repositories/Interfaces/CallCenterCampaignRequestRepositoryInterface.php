<?php

namespace Modules\CallCenter\Entities\CampaignRequests\Repositories\Interfaces;

use Modules\CallCenter\Entities\CampaignRequests\CallCenterCampaignRequest;
use Illuminate\Support\Collection;
use Illuminate\Http\UploadedFile;

interface CallCenterCampaignRequestRepositoryInterface
{
    public function listCallCenterCampaignRequests(int $totalView);

    public function createCallCenterCampaignRequest(array $params): CallCenterCampaignRequest;

    public function findCallCenterCampaignRequestById(int $id): CallCenterCampaignRequest;

    public function findTrashedCallCenterCampaignRequestById(int $id): CallCenterCampaignRequest;

    public function updateCallCenterCampaignRequest(array $params): bool;

    public function searchCallCenterCampaignRequest(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function saveDocumentFile(UploadedFile $file): string;

    public function countCallCenterCampaignRequests(string $text = null,  $from = null, $to = null);

    public function searchTrashedCallCenterCampaignRequest(string $text = null): Collection;

    public function deleteCallCenterCampaignRequest(): bool;

    public function recoverTrashedCallCenterCampaignRequest(): bool;
}
