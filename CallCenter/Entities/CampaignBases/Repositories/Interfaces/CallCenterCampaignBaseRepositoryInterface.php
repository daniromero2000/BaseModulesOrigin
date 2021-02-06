<?php

namespace Modules\CallCenter\Entities\CampaignBases\Repositories\Interfaces;

use Modules\CallCenter\Entities\CampaignBases\CallCenterCampaignBase;
use Illuminate\Support\Collection;

interface CallCenterCampaignBaseRepositoryInterface
{
    public function listCallCenterCampaignBases(int $totalView);

    public function createCallCenterCampaignBase(array $params): CallCenterCampaignBase;

    public function findCallCenterCampaignBaseById(int $id): CallCenterCampaignBase;

    public function findTrashedCallCenterCampaignBaseById(int $id): CallCenterCampaignBase;

    public function updateCallCenterCampaignBase(array $params): bool;

    public function searchCallCenterCampaignBase(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countCallCenterCampaignBases(string $text = null,  $from = null, $to = null);

    public function searchTrashedCallCenterCampaignBase(string $text = null): Collection;

    public function deleteCallCenterCampaignBase(): bool;

    public function destroyCallCenterCampaignBase($id): bool;

    public function recoverTrashedCallCenterCampaignBase(): bool;

    public function getCustomers($id, $totalView);

}
