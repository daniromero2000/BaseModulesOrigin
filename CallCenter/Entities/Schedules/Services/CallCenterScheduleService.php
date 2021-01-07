<?php

namespace Modules\CallCenter\Entities\Schedules\Services;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\CallCenter\Entities\Schedules\Repositories\Interfaces\CallCenterScheduleRepositoryInterface;
use Modules\CallCenter\Entities\Schedules\Repositories\CallCenterScheduleRepository;
use Modules\CallCenter\Entities\Schedules\Services\Interfaces\CallCenterScheduleServiceInterface;
use Carbon\Carbon;

class CallCenterScheduleService implements CallCenterScheduleServiceInterface
{
    protected $campaignRequestInterface, $toolsInterface;

    public function __construct(
        CallCenterScheduleRepositoryInterface $campaignRequestRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->campaignRequestInterface = $campaignRequestRepositoryInterface;
        $this->toolsInterface           = $toolRepositoryInterface;
    }

    public function listSchedules(array $data): array
    {
        $skip        = array_key_exists('skip', $data['search']) ? $data['search']['skip'] : 0;
        $fromOrigin  = array_key_exists('from', $data['search']) ? $data['search']['from'] . " 00:00:01" : '';
        $toOrigin    = array_key_exists('to', $data['search']) ? $data['search']['to'] . " 23:59:59" : '';
        $q           = array_key_exists('q', $data['search']) ? $data['search']['q'] : '';
        $search      = false;

        if ($q != '' && ($fromOrigin == '' || $toOrigin == '')) {
            $list     = $this->campaignRequestInterface->searchCallCenterSchedule($q, $skip * 30);
            $paginate = $this->campaignRequestInterface->countCallCenterSchedules($q, '');
            $search = true;
        } elseif (($q != '' || $fromOrigin != '' || $toOrigin != '')) {
            $from     = $fromOrigin != '' ? $fromOrigin : Carbon::now()->subMonths(1);
            $to       = $toOrigin != '' ? $toOrigin : Carbon::now();
            $list     = $this->campaignRequestInterface->searchCallCenterSchedule($q, $skip * 30, $from, $to);
            $paginate = $this->campaignRequestInterface->countCallCenterSchedules($q, $from, $to);
            $search = true;
        } else {
            $list     = $this->campaignRequestInterface->listCallCenterSchedules($skip * 30);
            $paginate = $this->campaignRequestInterface->countCallCenterSchedules('');
        }

        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $skip);

        return [
            'data' => [
                'campaignRequests'   => $list,
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

    public function saveSchedule(array $data): bool
    {
        if (!array_key_exists('company_id', $data['data'])) {
            $data['data']['company_id'] = auth()->guard('campaignRequest')->user()->company_id;
        }

        $this->campaignRequestInterface->createCallCenterSchedule($data['data']);
        return true;
    }

    public function updateSchedule(array $data): bool
    {
        $campaignRequest  = $this->campaignRequestInterface->findCallCenterScheduleById($data['id']);
        $repo             = new CallCenterScheduleRepository($campaignRequest);
        $repo->updateCallCenterSchedule($data['data']);
        return true;
    }

    public function deleteSchedule(int $id): bool
    {
        $campaignRequest     = $this->campaignRequestInterface->findCallCenterScheduleById($id);
        $campaignRequestRepo = new CallCenterScheduleRepository($campaignRequest);
        $campaignRequestRepo->deleteCallCenterSchedule();
        return true;
    }
}
