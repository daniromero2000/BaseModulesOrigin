<?php

namespace Modules\Warranty\Entities\WarrantyFeedbackQuestions\Repositories;

use Modules\Warranty\Entities\WarrantyFeedbackQuestions\Repositories\Interfaces\WarrantyFeedbackQuestionRepositoryInterface;
use Modules\Warranty\Entities\WarrantyFeedbackQuestions\WarrantyFeedbackQuestion;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class WarrantyFeedbackQuestionRepository implements WarrantyFeedbackQuestionRepositoryInterface
{
    private $columns = [
        'id',
        'name',
        'contact',
        'telphone',
        'type',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(WarrantyFeedbackQuestion $warrantyFeedbackQuestion)
    {
        $this->model = $warrantyFeedbackQuestion;
    }

    public function createWarrantyFeedbackQuestion(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateWarrantyFeedbackQuestion(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listWarrantyFeedbackQuestions($totalView): Support
    {
        try {
            return  $this->model->orderBy('created_at', 'asc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

}
