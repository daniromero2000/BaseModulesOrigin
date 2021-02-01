<?php

namespace Modules\CallCenter\Entities\Questionnaires\Services\Interfaces;
use Illuminate\Database\Eloquent\Model;

interface CallCenterQuestionnaireServiceInterface
{
    public function listQuestionnaires(array $data): array;

    public function saveQuestionnaire(array $data): bool;

    public function updateQuestionnaire(array $data): bool;

    public function showQuestionnaire($id): Model;

    public function deleteQuestionnaire(int $id): bool;
}
