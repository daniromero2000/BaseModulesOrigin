<?php

namespace Modules\CallCenter\Entities\Campaigns\Services\Interfaces;

interface CallCenterCampaignServiceInterface
{
    public function listCampaigns(array $data): array;

    public function saveCampaign(array $data): bool;

    public function updateCampaign(array $data): bool;

    public function deleteCampaign(int $id): bool;
}
