<?php

namespace Modules\CallCenter\Entities\QuestionnaireCampaigns\Repositories\Interfaces;

use Modules\CallCenter\Entities\QuestionnaireCampaigns\CallCenterQuestionnaireCampaign;
use Illuminate\Support\Collection;

interface CallCenterQuestionnaireCampaignRepositoryInterface
{
    public function listCallCenterQuestionnaireCampaigns(int $totalView);

    public function createCallCenterQuestionnaireCampaign(array $params): CallCenterQuestionnaireCampaign;

    public function findCallCenterQuestionnaireCampaignById(int $id): CallCenterQuestionnaireCampaign;

    public function findTrashedCallCenterQuestionnaireCampaignById(int $id): CallCenterQuestionnaireCampaign;

    public function updateCallCenterQuestionnaireCampaign(array $params): bool;

    public function searchCallCenterQuestionnaireCampaign(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countCallCenterQuestionnaireCampaigns(string $text = null,  $from = null, $to = null);

    public function searchTrashedCallCenterQuestionnaireCampaign(string $text = null): Collection;

    public function deleteCallCenterQuestionnaireCampaign(): bool;

    public function recoverTrashedCallCenterQuestionnaireCampaign(): bool;
}
