<?php

namespace Modules\CallCenter\Entities\Assignments\Services;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\CallCenter\Entities\Assignments\Repositories\Interfaces\CallCenterAssignmentRepositoryInterface;
use Modules\CallCenter\Entities\Assignments\Repositories\CallCenterAssignmentRepository;
use Modules\CallCenter\Entities\Assignments\Services\Interfaces\CallCenterAssignmentServiceInterface;
use Carbon\Carbon;

class CallCenterAssignmentService implements CallCenterAssignmentServiceInterface
{
    protected $assignmentInterface, $toolsInterface;

    public function __construct(
        CallCenterAssignmentRepositoryInterface $assignmentRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->assignmentInterface = $assignmentRepositoryInterface;
        $this->toolsInterface           = $toolRepositoryInterface;
    }

    public function listAssignments(array $data): array
    {
        $skip        = array_key_exists('skip', $data['search']) ? $data['search']['skip'] : 0;
        $fromOrigin  = array_key_exists('from', $data['search']) ? $data['search']['from'] . " 00:00:01" : '';
        $toOrigin    = array_key_exists('to', $data['search']) ? $data['search']['to'] . " 23:59:59" : '';
        $q           = array_key_exists('q', $data['search']) ? $data['search']['q'] : '';
        $search      = false;

        if ($q != '' && ($fromOrigin == '' || $toOrigin == '')) {
            $list     = $this->assignmentInterface->searchCallCenterAssignment($q, $skip * 30);
            $paginate = $this->assignmentInterface->countCallCenterAssignments($q, '');
            $search = true;
        } elseif (($q != '' || $fromOrigin != '' || $toOrigin != '')) {
            $from     = $fromOrigin != '' ? $fromOrigin : Carbon::now()->subMonths(1);
            $to       = $toOrigin != '' ? $toOrigin : Carbon::now();
            $list     = $this->assignmentInterface->searchCallCenterAssignment($q, $skip * 30, $from, $to);
            $paginate = $this->assignmentInterface->countCallCenterAssignments($q, $from, $to);
            $search = true;
        } else {
            $list     = $this->assignmentInterface->listCallCenterAssignments($skip * 30);
            $paginate = $this->assignmentInterface->countCallCenterAssignments('');
        }

        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $skip);

        return [
            'data' => [
                'assignments'   => $list,
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

    public function saveAssignment(array $data): bool
    {
        if (!array_key_exists('company_id', $data['data'])) {
            $data['data']['company_id'] = auth()->guard('assignment')->user()->company_id;
        }

        $this->assignmentInterface->createCallCenterAssignment($data['data']);
        return true;
    }

    public function updateAssignment(array $data): bool
    {
        $assignment  = $this->assignmentInterface->findCallCenterAssignmentById($data['id']);
        $repo             = new CallCenterAssignmentRepository($assignment);
        $repo->updateCallCenterAssignment($data['data']);
        return true;
    }

    public function deleteAssignment(int $id): bool
    {
        $assignment     = $this->assignmentInterface->findCallCenterAssignmentById($id);
        $assignmentRepo = new CallCenterAssignmentRepository($assignment);
        $assignmentRepo->deleteCallCenterAssignment();
        return true;
    }
}
