<?php

namespace Modules\CallCenter\Entities\QuestionnaireQuestions\Services\Interfaces;

interface CallCenterQuestionnaireQuestionServiceInterface
{
    public function listQuestionnaireQuestions(array $data): array;

    public function saveQuestionnaireQuestion(array $data): bool;

    public function updateQuestionnaireQuestion(array $data): bool;

    public function deleteQuestionnaireQuestion(int $id): bool;
}
