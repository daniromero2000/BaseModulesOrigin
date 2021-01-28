<?php

namespace Modules\CallCenter\Entities\QuestionnaireQuestions\Services;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\CallCenter\Entities\QuestionnaireQuestions\Repositories\Interfaces\CallCenterQuestionnaireQuestionRepositoryInterface;
use Modules\CallCenter\Entities\QuestionnaireQuestions\Repositories\CallCenterQuestionnaireQuestionRepository;
use Modules\CallCenter\Entities\QuestionnaireQuestions\Services\Interfaces\CallCenterQuestionnaireQuestionServiceInterface;
use Carbon\Carbon;

class CallCenterQuestionnaireQuestionService implements CallCenterQuestionnaireQuestionServiceInterface
{
    protected $questionnaireInterface, $toolsInterface;

    public function __construct(
        CallCenterQuestionnaireQuestionRepositoryInterface $questionnaireRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->questionnaireInterface = $questionnaireRepositoryInterface;
        $this->toolsInterface           = $toolRepositoryInterface;
    }

    public function listQuestionnaireQuestions(array $data): array
    {
        $skip        = array_key_exists('skip', $data['search']) ? $data['search']['skip'] : 0;
        $fromOrigin  = array_key_exists('from', $data['search']) ? $data['search']['from'] . " 00:00:01" : '';
        $toOrigin    = array_key_exists('to', $data['search']) ? $data['search']['to'] . " 23:59:59" : '';
        $q           = array_key_exists('q', $data['search']) ? $data['search']['q'] : '';
        $search      = false;

        if ($q != '' && ($fromOrigin == '' || $toOrigin == '')) {
            $list     = $this->questionnaireInterface->searchCallCenterQuestionnaireQuestion($q, $skip * 30);
            $paginate = $this->questionnaireInterface->countCallCenterQuestionnaireQuestions($q, '');
            $search = true;
        } elseif (($q != '' || $fromOrigin != '' || $toOrigin != '')) {
            $from     = $fromOrigin != '' ? $fromOrigin : Carbon::now()->subMonths(1);
            $to       = $toOrigin != '' ? $toOrigin : Carbon::now();
            $list     = $this->questionnaireInterface->searchCallCenterQuestionnaireQuestion($q, $skip * 30, $from, $to);
            $paginate = $this->questionnaireInterface->countCallCenterQuestionnaireQuestions($q, $from, $to);
            $search = true;
        } else {
            $list     = $this->questionnaireInterface->listCallCenterQuestionnaireQuestions($skip * 30);
            $paginate = $this->questionnaireInterface->countCallCenterQuestionnaireQuestions('');
        }

        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $skip);

        return [
            'data' => [
                'questionnaires'   => $list,
                'optionsRoutes'      => 'admin.' . (request()->segment(2)),
                'headers'            => ['Nombre', 'Email', 'Cargo', 'Estado', 'Opciones'],
                'searchInputs'       => [
                    ['label' => 'Buscar', 'type' => 'text', 'name' => 'q'],
                    ['label' => 'Desde', 'type' => 'date', 'name' => 'from'],
                    ['label' => 'Hasta', 'type' => 'date', 'name' => 'to']
                ],
                'inputs' => [
                    ['label' => 'Nombre', 'type' => 'text', 'name' => 'name'],
                    ['label' => 'Apellido', 'type' => 'text', 'name' => 'last_name'],
                    ['label' => 'Email', 'type' => 'text', 'name' => 'email'],
                    ['label' => 'Password', 'type' => 'password', 'name' => 'password'],
                    ['label' => 'Tipo Sangre', 'type' => 'text', 'name' => 'rh'],
                    ['label' => 'Fecha Nacimiento', 'type' => 'date', 'name' => 'birthday']
                ],
                'skip'               => $skip,
                'paginate'           => $getPaginate['paginate'],
                'position'           => $getPaginate['position'],
                'page'               => $getPaginate['page'],
                'limit'              => $getPaginate['limit']
            ],
            'search'  => $search
        ];
    }

    public function saveQuestionnaireQuestion(array $data): bool
    {
        $questions       = [];
        $dataQuestionary = [];

        foreach ($data['items'] as $key => $value) {
            $questions['questions'][$key] = [
                'question'   => $data['data']['questions'][$key],
                'typeAnswer' => $data['data']['typeAnswer'][$key]
            ];
        }

        $dataQuestionary['name']   = $data['data']['name'];
        $dataQuestionary['status'] = '1';

        $questionnaire = $this->questionnaireInterface->createCallCenterQuestionnaireQuestion($dataQuestionary);

        

        return true;
    }

    public function updateQuestionnaireQuestion(array $data): bool
    {
        $questionnaire  = $this->questionnaireInterface->findCallCenterQuestionnaireQuestionById($data['id']);
        $repo             = new CallCenterQuestionnaireQuestionRepository($questionnaire);
        $repo->updateCallCenterQuestionnaireQuestion($data['data']);
        return true;
    }

    public function deleteQuestionnaireQuestion(int $id): bool
    {
        $questionnaire     = $this->questionnaireInterface->findCallCenterQuestionnaireQuestionById($id);
        $questionnaireRepo = new CallCenterQuestionnaireQuestionRepository($questionnaire);
        $questionnaireRepo->deleteCallCenterQuestionnaireQuestion();
        return true;
    }
}
