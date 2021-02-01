<?php

namespace Modules\CallCenter\Entities\QuestionnaireQuestions\Repositories\Interfaces;

use Modules\CallCenter\Entities\QuestionnaireQuestions\CallCenterQuestionnaireQuestion;
use Illuminate\Support\Collection;

interface CallCenterQuestionnaireQuestionRepositoryInterface
{
    public function listCallCenterQuestionnaireQuestions(int $totalView);

    public function createCallCenterQuestionnaireQuestion(array $params): CallCenterQuestionnaireQuestion;

    public function findCallCenterQuestionnaireQuestionById(int $id): CallCenterQuestionnaireQuestion;

    public function findTrashedCallCenterQuestionnaireQuestionById(int $id): CallCenterQuestionnaireQuestion;

    public function updateCallCenterQuestionnaireQuestion(array $params): bool;

    public function searchCallCenterQuestionnaireQuestion(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countCallCenterQuestionnaireQuestions(string $text = null,  $from = null, $to = null);

    public function searchTrashedCallCenterQuestionnaireQuestion(string $text = null): Collection;

    public function deleteCallCenterQuestionnaireQuestion(): bool;

    public function destroyCallCenterQuestionnaireQuestions($id): bool;

    public function recoverTrashedCallCenterQuestionnaireQuestion(): bool;
}
