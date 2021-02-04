<?php

namespace Modules\CallCenter\Entities\Campaigns\Services\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface CallCenterCampaignServiceInterface
{
    public function listCampaigns(array $data): array;

    public function saveCampaign(array $data): Model;

    public function saveFileCampaign($data);

    public function getDataCreate(): array;

    public function downloadFileCampaign($id);

    public function updateCampaign(array $data): bool;

    public function destroyCampaignBase(int $id): bool;

    public function deleteCampaign(int $id): bool;
}
