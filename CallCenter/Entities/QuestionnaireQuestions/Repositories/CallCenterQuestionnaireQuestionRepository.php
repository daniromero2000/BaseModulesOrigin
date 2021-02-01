<?php

namespace Modules\CallCenter\Entities\QuestionnaireQuestions\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\CallCenter\Entities\QuestionnaireQuestions\CallCenterQuestionnaireQuestion;
use Modules\CallCenter\Entities\QuestionnaireQuestions\Exceptions\CreateQuestionnaireQuestionErrorException;
use Modules\CallCenter\Entities\QuestionnaireQuestions\Exceptions\QuestionnaireQuestionNotFoundException;
use Modules\CallCenter\Entities\QuestionnaireQuestions\Exceptions\UpdateQuestionnaireQuestionErrorException;
use Modules\CallCenter\Entities\QuestionnaireQuestions\Repositories\Interfaces\CallCenterQuestionnaireQuestionRepositoryInterface;

class CallCenterQuestionnaireQuestionRepository implements CallCenterQuestionnaireQuestionRepositoryInterface
{
    protected $model;
    private $columns = [
         'id',
        'id_call_center_questionnaire',
        'question',
        'typeAnswer'
    ];

    private $listColumns = [
         'id',
        'id_call_center_questionnaire',
        'question',
        'typeAnswer'
    ];

    private $questionnaireRequestColumns = [
         'id',
        'id_call_center_questionnaire',
        'question',
        'typeAnswer'
    ];

    public function __construct(CallCenterQuestionnaireQuestion $questionnaireRequest)
    {
        $this->model = $questionnaireRequest;
    }

    public function listCallCenterQuestionnaireQuestions(int $totalView)
    {
        try {
            return  $this->model
                ->orderBy('id', 'desc')
                ->skip($totalView)->take(30)
                ->get($this->listColumns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchCallCenterQuestionnaireQuestion(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (empty($text) && is_null($from) && is_null($to)) {
                return $this->listCallCenterQuestionnaireQuestions($totalView);
            }

            if (!empty($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchCallCenterQuestionnaireQuestion($text, null, true, true)
                    ->skip($totalView)
                    ->take(30)
                    ->get($this->columns);
            }

            if (empty($text) && (!is_null($from) || !is_null($to))) {
                return $this->model->whereBetween('created_at', [$from, $to])
                    ->skip($totalView)
                    ->take(30)
                    ->get($this->columns);
            }

            return $this->model->searchCallCenterQuestionnaireQuestion($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countCallCenterQuestionnaireQuestions(string $text = null,  $from = null, $to = null)
    {
        if (empty($text) && is_null($from) && is_null($to)) {
            return $this->model->count('id');
        }

        if (!empty($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchCallCenterQuestionnaireQuestion($text, null, true, true)
                ->count('id');
        }

        if (empty($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->count('id');
        }

        return $this->model->searchCallCenterQuestionnaireQuestion($text, null, true, true)
            ->whereBetween('created_at', [$from, $to])
            ->count('id');
    }

    public function searchTrashedCallCenterQuestionnaireQuestion(string $text = null): Collection
    {
        if (empty($text)) {
            return $this->model->onlyTrashed($text)->get($this->columns);
        }

        return $this->model->onlyTrashed()->get($this->columns);
    }

    public function createCallCenterQuestionnaireQuestion(array $data): CallCenterQuestionnaireQuestion
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateQuestionnaireQuestionErrorException($e);
        }
    }

    public function findCallCenterQuestionnaireQuestionById(int $id): CallCenterQuestionnaireQuestion
    {
        try {
            return $this->model->findOrFail($id, $this->questionnaireRequestColumns);
        } catch (ModelNotFoundException $e) {
            throw new QuestionnaireQuestionNotFoundException($e);
        }
    }

    public function findCallCenterQuestionnaireQuestionByQuestionnare(int $id)
    {
        try {
            return $this->model->where('id_call_center_questionnaire', $id)->get();
        } catch (ModelNotFoundException $e) {
            throw new QuestionnaireQuestionNotFoundException($e);
        }
    }

    public function findTrashedCallCenterQuestionnaireQuestionById(int $id): CallCenterQuestionnaireQuestion
    {
        try {
            return $this->model->withTrashed()->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new QuestionnaireQuestionNotFoundException($e);
        }
    }

    public function updateCallCenterQuestionnaireQuestion(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            throw new UpdateQuestionnaireQuestionErrorException($e);
        }
    }

    public function destroyCallCenterQuestionnaireQuestions($id): bool
    {
        try {
            return $this->model->where('id_call_center_questionnaire', $id)->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }


    public function deleteCallCenterQuestionnaireQuestion(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function recoverTrashedCallCenterQuestionnaireQuestion(): bool
    {
        try {
            return $this->model->restore();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
