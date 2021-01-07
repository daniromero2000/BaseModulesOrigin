<?php

namespace Modules\CallCenter\Entities\Managements\Services;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\CallCenter\Entities\Managements\Repositories\Interfaces\CallCenterManagementRepositoryInterface;
use Modules\CallCenter\Entities\Managements\Repositories\CallCenterManagementRepository;
use Modules\CallCenter\Entities\Managements\Services\Interfaces\CallCenterManagementServiceInterface;
use Carbon\Carbon;

class CallCenterManagementService implements CallCenterManagementServiceInterface
{
    protected $managementInterface, $toolsInterface;

    public function __construct(
        CallCenterManagementRepositoryInterface $managementRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->managementInterface = $managementRepositoryInterface;
        $this->toolsInterface      = $toolRepositoryInterface;
    }

    public function listManagements(array $data): array
    {
        $skip        = array_key_exists('skip', $data['search']) ? $data['search']['skip'] : 0;
        $fromOrigin  = array_key_exists('from', $data['search']) ? $data['search']['from'] . " 00:00:01" : '';
        $toOrigin    = array_key_exists('to', $data['search']) ? $data['search']['to'] . " 23:59:59" : '';
        $q           = array_key_exists('q', $data['search']) ? $data['search']['q'] : '';
        $search      = false;

        if ($q != '' && ($fromOrigin == '' || $toOrigin == '')) {
            $list     = $this->managementInterface->searchCallCenterManagement($q, $skip * 30);
            $paginate = $this->managementInterface->countCallCenterManagements($q, '');
            $search = true;
        } elseif (($q != '' || $fromOrigin != '' || $toOrigin != '')) {
            $from     = $fromOrigin != '' ? $fromOrigin : Carbon::now()->subMonths(1);
            $to       = $toOrigin != '' ? $toOrigin : Carbon::now();
            $list     = $this->managementInterface->searchCallCenterManagement($q, $skip * 30, $from, $to);
            $paginate = $this->managementInterface->countCallCenterManagements($q, $from, $to);
            $search = true;
        } else {
            $list     = $this->managementInterface->listCallCenterManagements($skip * 30);
            $paginate = $this->managementInterface->countCallCenterManagements('');
        }

        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $skip);

        return [
            'data' => [
                'managements'   => $list,
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

    public function saveManagement(array $data): bool
    {
        if (!array_key_exists('company_id', $data['data'])) {
            $data['data']['company_id'] = auth()->guard('management')->user()->company_id;
        }

        $this->managementInterface->createCallCenterManagement($data['data']);
        return true;
    }

    public function updateManagement(array $data): bool
    {
        $management  = $this->managementInterface->findCallCenterManagementById($data['id']);
        $repo             = new CallCenterManagementRepository($management);
        $repo->updateCallCenterManagement($data['data']);
        return true;
    }

    public function deleteManagement(int $id): bool
    {
        $management     = $this->managementInterface->findCallCenterManagementById($id);
        $managementRepo = new CallCenterManagementRepository($management);
        $managementRepo->deleteCallCenterManagement();
        return true;
    }
}
