<?php

namespace Modules\Warranty\Entities\WarrantyFeedbackQuestions\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface WarrantyFeedbackQuestionRepositoryInterface
{
    public function createWarrantyFeedbackQuestion(array $data);

    public function updateWarrantyFeedbackQuestion(array $data);

    public function listWarrantyFeedbackQuestions($totalView): Support;
}
