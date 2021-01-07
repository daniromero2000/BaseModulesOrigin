<?php

namespace Modules\CallCenter\Entities\Campaigns\Repositories\Interfaces;

use Modules\CallCenter\Entities\Campaigns\CallCenterCampaign;
use Illuminate\Support\Collection;

interface CallCenterCampaignRepositoryInterface
{
    public function listCallCenterCampaigns(int $totalView);

    public function createCallCenterCampaign(array $params): CallCenterCampaign;

    public function findCallCenterCampaignById(int $id): CallCenterCampaign;

    public function findTrashedCallCenterCampaignById(int $id): CallCenterCampaign;

    public function updateCallCenterCampaign(array $params): bool;

    public function searchCallCenterCampaign(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countCallCenterCampaigns(string $text = null,  $from = null, $to = null);

    public function searchTrashedCallCenterCampaign(string $text = null): Collection;

    public function deleteCallCenterCampaign(): bool;

    public function recoverTrashedCallCenterCampaign(): bool;
}
