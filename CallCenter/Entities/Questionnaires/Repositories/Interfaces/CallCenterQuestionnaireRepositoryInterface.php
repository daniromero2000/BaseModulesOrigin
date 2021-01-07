<?php

namespace Modules\CallCenter\Entities\Questionnaires\Repositories\Interfaces;

use Modules\CallCenter\Entities\Questionnaires\CallCenterQuestionnaire;
use Illuminate\Support\Collection;

interface CallCenterQuestionnaireRepositoryInterface
{
    public function listCallCenterQuestionnaires(int $totalView);

    public function createCallCenterQuestionnaire(array $params): CallCenterQuestionnaire;

    public function findCallCenterQuestionnaireById(int $id): CallCenterQuestionnaire;

    public function findTrashedCallCenterQuestionnaireById(int $id): CallCenterQuestionnaire;

    public function updateCallCenterQuestionnaire(array $params): bool;

    public function searchCallCenterQuestionnaire(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countCallCenterQuestionnaires(string $text = null,  $from = null, $to = null);

    public function searchTrashedCallCenterQuestionnaire(string $text = null): Collection;

    public function deleteCallCenterQuestionnaire(): bool;

    public function recoverTrashedCallCenterQuestionnaire(): bool;
}
