<?php

namespace Modules\CallCenter\Entities\Campaigns\Services\Interfaces;

interface CallCenterCampaignServiceInterface
{
    public function listCampaigns(array $data): array;

    public function saveCampaign(array $data): bool;

    public function saveFileCampaign($data);

    public function getDataCreate(): array;

    public function downloadFileCampaign($id);

    public function updateCampaign(array $data): bool;

    public function deleteCampaign(int $id): bool;
}
