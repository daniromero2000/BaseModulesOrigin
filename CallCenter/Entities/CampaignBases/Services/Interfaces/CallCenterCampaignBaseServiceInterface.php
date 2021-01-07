<?php

namespace Modules\CallCenter\Entities\CampaignBases\Services\Interfaces;

interface CallCenterCampaignBaseServiceInterface
{
    public function listCampaignBases(array $data): array;

    public function saveCampaignBase(array $data): bool;

    public function updateCampaignBase(array $data): bool;

    public function deleteCampaignBase(int $id): bool;
}
