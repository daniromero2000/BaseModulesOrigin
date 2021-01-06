<?php

namespace Modules\CallCenter\Entities\CampaignRequests\Services\Interfaces;

interface CallCenterCampaignRequestServiceInterface
{
    public function listCampaignRequests(array $data): array;

    public function saveCampaignRequest($data): bool;

    public function saveFileCampaignRequest($data);

    public function updateCampaignRequest(array $data): bool;

    public function deleteCampaignRequest(int $id): bool;
}
