<?php

namespace Modules\CallCenter\Entities\Questionnaires\Services;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\CallCenter\Entities\Questionnaires\Repositories\Interfaces\CallCenterQuestionnaireRepositoryInterface;
use Modules\CallCenter\Entities\Questionnaires\Repositories\CallCenterQuestionnaireRepository;
use Modules\CallCenter\Entities\Questionnaires\Services\Interfaces\CallCenterQuestionnaireServiceInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\CallCenter\Entities\QuestionnaireQuestions\Repositories\CallCenterQuestionnaireQuestionRepository;
use Modules\CallCenter\Entities\QuestionnaireQuestions\Repositories\Interfaces\CallCenterQuestionnaireQuestionRepositoryInterface;

class CallCenterQuestionnaireService implements CallCenterQuestionnaireServiceInterface
{
    protected $questionnaireInterface, $toolsInterface;

    public function __construct(
        CallCenterQuestionnaireRepositoryInterface $questionnaireRepositoryInterface,
        CallCenterQuestionnaireQuestionRepositoryInterface $questionnaireQuestionRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->questionnaireInterface         = $questionnaireRepositoryInterface;
        $this->questionnaireQuestionInterface = $questionnaireQuestionRepositoryInterface;
        $this->toolsInterface                 = $toolRepositoryInterface;
    }

    public function listQuestionnaires(array $data): array
    {
        $skip        = array_key_exists('skip', $data['search']) ? $data['search']['skip'] : 0;
        $fromOrigin  = array_key_exists('from', $data['search']) ? $data['search']['from'] . " 00:00:01" : '';
        $toOrigin    = array_key_exists('to', $data['search']) ? $data['search']['to'] . " 23:59:59" : '';
        $q           = array_key_exists('q', $data['search']) ? $data['search']['q'] : '';
        $search      = false;

        if ($q != '' && ($fromOrigin == '' || $toOrigin == '')) {
            $list     = $this->questionnaireInterface->searchCallCenterQuestionnaire($q, $skip * 30);
            $paginate = $this->questionnaireInterface->countCallCenterQuestionnaires($q, '');
            $search = true;
        } elseif (($q != '' || $fromOrigin != '' || $toOrigin != '')) {
            $from     = $fromOrigin != '' ? $fromOrigin : Carbon::now()->subMonths(1);
            $to       = $toOrigin != '' ? $toOrigin : Carbon::now();
            $list     = $this->questionnaireInterface->searchCallCenterQuestionnaire($q, $skip * 30, $from, $to);
            $paginate = $this->questionnaireInterface->countCallCenterQuestionnaires($q, $from, $to);
            $search = true;
        } else {
            $list     = $this->questionnaireInterface->listCallCenterQuestionnaires($skip * 30);
            $paginate = $this->questionnaireInterface->countCallCenterQuestionnaires('');
        }

        $list = $list->map(function ($item) {
            if ($item->status == 0) {
                $item->status = ['status' => 'Inactivo', 'color' => '#FFFFFF', 'background' => '#007bff'];
            } else {
                $item->status = ['status' => 'Activo', 'color' => '#FFFFFF', 'background' => '#007bff'];
            }
            $item->status = collect($item->status);
            return $item;
        })->all();

        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $skip);

        return [
            'data' => [
                'list'          =>  collect($list),
                'optionsRoutes' => 'admin.' . (request()->segment(2)),
                'headers'       => ['Nombre', 'Estado', 'Opciones'],
                'searchInputs'  => [
                    ['label' => 'Buscar', 'type' => 'text', 'name' => 'q'],
                    ['label' => 'Desde', 'type' => 'date', 'name' => 'from'],
                    ['label' => 'Hasta', 'type' => 'date', 'name' => 'to']
                ],
                'inputs' => [
                    ['label' => 'Nombre', 'type' => 'text', 'name' => 'name'],
                ],
                'skip'      => $skip,
                'paginate'  => $getPaginate['paginate'],
                'position'  => $getPaginate['position'],
                'page'      => $getPaginate['page'],
                'limit'     => $getPaginate['limit']
            ],
            'search'  => $search
        ];
    }

    public function saveQuestionnaire(array $data): bool
    {
        $questions       = [];
        $dataQuestion    = [];
        $dataQuestionary = [];

        foreach ($data['items'] as $key => $value) {
            $questions['questions'][$key] = [
                'question'   => $data['data']['questions'][$key],
                'typeAnswer' => $data['data']['typeAnswer'][$key]
            ];
        }

        $dataQuestionary['name']   = $data['data']['name'];
        $dataQuestionary['status'] = '1';

        $questionnaire = $this->questionnaireInterface->createCallCenterQuestionnaire($dataQuestionary);

        foreach ($questions['questions'] as $key => $value) {
            $dataQuestion = $value;
            $dataQuestion['id_call_center_questionnaire'] =  $questionnaire->id;
            $this->questionnaireQuestionInterface->createCallCenterQuestionnaireQuestion($dataQuestion);
            $dataQuestion    = [];
        }

        return true;
    }

    public function updateQuestionnaire(array $data): bool
    {
        $dataQuestionary = $data;
        unset($dataQuestionary['questions']);

        $questionnaire  = $this->questionnaireInterface->findCallCenterQuestionnaireById($data['id']);
        $repo           = new CallCenterQuestionnaireRepository($questionnaire);
        $repo->updateCallCenterQuestionnaire($dataQuestionary);

        $this->questionnaireQuestionInterface->destroyCallCenterQuestionnaireQuestions($questionnaire->id);

        foreach ($data['questions'] as $key => $value) {
            unset($value['id']);
            $dataQuestion = $value;
            $dataQuestion['id_call_center_questionnaire'] =  $questionnaire->id;
            $this->questionnaireQuestionInterface->createCallCenterQuestionnaireQuestion($dataQuestion);
            $dataQuestion    = [];
        }

        return true;
    }

    public function showQuestionnaire($id): Model
    {
        return $this->questionnaireInterface->findCallCenterQuestionnaireById($id);
    }

    public function deleteQuestionnaire(int $id): bool
    {
        $questionnaire     = $this->questionnaireInterface->findCallCenterQuestionnaireById($id);
        $questionnaireRepo = new CallCenterQuestionnaireRepository($questionnaire);
        $questionnaireRepo->deleteCallCenterQuestionnaire();
        return true;
    }
}
