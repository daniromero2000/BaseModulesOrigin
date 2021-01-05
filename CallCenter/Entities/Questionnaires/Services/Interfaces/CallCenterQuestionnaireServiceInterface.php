<?php

namespace Modules\CallCenter\Entities\Questionnaires\Services\Interfaces;

interface CallCenterQuestionnaireServiceInterface
{
    public function listQuestionnaires(array $data): array;

    public function saveQuestionnaire(array $data): bool;

    public function updateQuestionnaire(array $data): bool;

    public function deleteQuestionnaire(int $id): bool;
}
