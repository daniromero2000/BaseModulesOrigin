<?php

namespace Modules\CallCenter\Entities\QuestionnaireCampaigns\Services\Interfaces;

interface CallCenterQuestionnaireCampaignServiceInterface
{
    public function listQuestionnaireCampaigns(array $data): array;

    public function saveQuestionnaireCampaign(array $data): bool;

    public function updateQuestionnaireCampaign(array $data): bool;

    public function deleteQuestionnaireCampaign(int $id): bool;
}
