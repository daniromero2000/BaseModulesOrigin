<?php

namespace Modules\CallCenter\Entities\Questionnaires\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\CallCenter\Entities\Questionnaires\CallCenterQuestionnaire;
use Modules\CallCenter\Entities\Questionnaires\Exceptions\CreateQuestionnaireErrorException;
use Modules\CallCenter\Entities\Questionnaires\Exceptions\QuestionnaireNotFoundException;
use Modules\CallCenter\Entities\Questionnaires\Exceptions\UpdateQuestionnaireErrorException;
use Modules\CallCenter\Entities\Questionnaires\Repositories\Interfaces\CallCenterQuestionnaireRepositoryInterface;

class CallCenterQuestionnaireRepository implements CallCenterQuestionnaireRepositoryInterface
{
    protected $model;
    private $columns = [
        'employee_id',
        'campaign',
        'script',
        'description',
        'src'
    ];

    private $listColumns = [
        'employee_id',
        'campaign',
        'script',
        'description',
        'src'
    ];

    private $campaignRequestColumns = [
        'employee_id',
        'campaign',
        'script',
        'description',
        'src'
    ];

    public function __construct(CallCenterQuestionnaire $campaignRequest)
    {
        $this->model = $campaignRequest;
    }

    public function listCallCenterQuestionnaires(int $totalView)
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

    public function searchCallCenterQuestionnaire(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (empty($text) && is_null($from) && is_null($to)) {
                return $this->listCallCenterQuestionnaires($totalView);
            }

            if (!empty($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchCallCenterQuestionnaire($text, null, true, true)
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

            return $this->model->searchCallCenterQuestionnaire($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countCallCenterQuestionnaires(string $text = null,  $from = null, $to = null)
    {
        if (empty($text) && is_null($from) && is_null($to)) {
            return $this->model->count('id');
        }

        if (!empty($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchCallCenterQuestionnaire($text, null, true, true)
                ->count('id');
        }

        if (empty($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->count('id');
        }

        return $this->model->searchCallCenterQuestionnaire($text, null, true, true)
            ->whereBetween('created_at', [$from, $to])
            ->count('id');
    }

    public function searchTrashedCallCenterQuestionnaire(string $text = null): Collection
    {
        if (empty($text)) {
            return $this->model->onlyTrashed($text)->get($this->columns);
        }

        return $this->model->onlyTrashed()->get($this->columns);
    }

    public function createCallCenterQuestionnaire(array $data): CallCenterQuestionnaire
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateQuestionnaireErrorException($e);
        }
    }

    public function findCallCenterQuestionnaireById(int $id): CallCenterQuestionnaire
    {
        try {
            return $this->model->findOrFail($id, $this->campaignRequestColumns);
        } catch (ModelNotFoundException $e) {
            throw new QuestionnaireNotFoundException($e);
        }
    }

    public function findTrashedCallCenterQuestionnaireById(int $id): CallCenterQuestionnaire
    {
        try {
            return $this->model->withTrashed()->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new QuestionnaireNotFoundException($e);
        }
    }

    public function updateCallCenterQuestionnaire(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            throw new UpdateQuestionnaireErrorException($e);
        }
    }

    public function deleteCallCenterQuestionnaire(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function recoverTrashedCallCenterQuestionnaire(): bool
    {
        try {
            return $this->model->restore();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
