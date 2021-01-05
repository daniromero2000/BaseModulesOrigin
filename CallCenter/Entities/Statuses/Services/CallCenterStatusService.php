<?php

namespace Modules\CallCenter\Entities\Statuses\Services;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\CallCenter\Entities\Statuses\Repositories\Interfaces\CallCenterStatusRepositoryInterface;
use Modules\CallCenter\Entities\Statuses\Repositories\CallCenterStatusRepository;
use Modules\CallCenter\Entities\Statuses\Services\Interfaces\CallCenterStatusServiceInterface;
use Carbon\Carbon;

class CallCenterStatusService implements CallCenterStatusServiceInterface
{
    protected $campaignRequestInterface, $toolsInterface;

    public function __construct(
        CallCenterStatusRepositoryInterface $campaignRequestRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->campaignRequestInterface = $campaignRequestRepositoryInterface;
        $this->toolsInterface           = $toolRepositoryInterface;
    }

    public function listStatuses(array $data): array
    {
        $skip        = array_key_exists('skip', $data['search']) ? $data['search']['skip'] : 0;
        $fromOrigin  = array_key_exists('from', $data['search']) ? $data['search']['from'] . " 00:00:01" : '';
        $toOrigin    = array_key_exists('to', $data['search']) ? $data['search']['to'] . " 23:59:59" : '';
        $q           = array_key_exists('q', $data['search']) ? $data['search']['q'] : '';
        $search      = false;

        if ($q != '' && ($fromOrigin == '' || $toOrigin == '')) {
            $list     = $this->campaignRequestInterface->searchCallCenterStatus($q, $skip * 30);
            $paginate = $this->campaignRequestInterface->countCallCenterStatuses($q, '');
            $search = true;
        } elseif (($q != '' || $fromOrigin != '' || $toOrigin != '')) {
            $from     = $fromOrigin != '' ? $fromOrigin : Carbon::now()->subMonths(1);
            $to       = $toOrigin != '' ? $toOrigin : Carbon::now();
            $list     = $this->campaignRequestInterface->searchCallCenterStatus($q, $skip * 30, $from, $to);
            $paginate = $this->campaignRequestInterface->countCallCenterStatuses($q, $from, $to);
            $search = true;
        } else {
            $list     = $this->campaignRequestInterface->listCallCenterStatuses($skip * 30);
            $paginate = $this->campaignRequestInterface->countCallCenterStatuses('');
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

    public function saveStatus(array $data): bool
    {
        if (!array_key_exists('company_id', $data['data'])) {
            $data['data']['company_id'] = auth()->guard('campaignRequest')->user()->company_id;
        }

        $this->campaignRequestInterface->createCallCenterStatus($data['data']);
        return true;
    }

    public function updateStatus(array $data): bool
    {
        $campaignRequest  = $this->campaignRequestInterface->findCallCenterStatusById($data['id']);
        $repo             = new CallCenterStatusRepository($campaignRequest);
        $repo->updateCallCenterStatus($data['data']);
        return true;
    }

    public function deleteStatus(int $id): bool
    {
        $campaignRequest     = $this->campaignRequestInterface->findCallCenterStatusById($id);
        $campaignRequestRepo = new CallCenterStatusRepository($campaignRequest);
        $campaignRequestRepo->deleteCallCenterStatus();
        return true;
    }
}
