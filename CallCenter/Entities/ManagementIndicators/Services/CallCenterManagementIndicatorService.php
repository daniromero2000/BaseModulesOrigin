<?php

namespace Modules\CallCenter\Entities\ManagementIndicators\Services;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\CallCenter\Entities\ManagementIndicators\Repositories\Interfaces\CallCenterManagementIndicatorRepositoryInterface;
use Modules\CallCenter\Entities\ManagementIndicators\Repositories\CallCenterManagementIndicatorRepository;
use Modules\CallCenter\Entities\ManagementIndicators\Services\Interfaces\CallCenterManagementIndicatorServiceInterface;
use Carbon\Carbon;

class CallCenterManagementIndicatorService implements CallCenterManagementIndicatorServiceInterface
{
    protected $managementIndicatorInterface, $toolsInterface;

    public function __construct(
        CallCenterManagementIndicatorRepositoryInterface $managementIndicatorRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->managementIndicatorInterface = $managementIndicatorRepositoryInterface;
        $this->toolsInterface           = $toolRepositoryInterface;
    }

    public function listManagementIndicators(array $data): array
    {
        $skip        = array_key_exists('skip', $data['search']) ? $data['search']['skip'] : 0;
        $fromOrigin  = array_key_exists('from', $data['search']) ? $data['search']['from'] . " 00:00:01" : '';
        $toOrigin    = array_key_exists('to', $data['search']) ? $data['search']['to'] . " 23:59:59" : '';
        $q           = array_key_exists('q', $data['search']) ? $data['search']['q'] : '';
        $search      = false;

        if ($q != '' && ($fromOrigin == '' || $toOrigin == '')) {
            $list     = $this->managementIndicatorInterface->searchCallCenterManagementIndicator($q, $skip * 30);
            $paginate = $this->managementIndicatorInterface->countCallCenterManagementIndicators($q, '');
            $search = true;
        } elseif (($q != '' || $fromOrigin != '' || $toOrigin != '')) {
            $from     = $fromOrigin != '' ? $fromOrigin : Carbon::now()->subMonths(1);
            $to       = $toOrigin != '' ? $toOrigin : Carbon::now();
            $list     = $this->managementIndicatorInterface->searchCallCenterManagementIndicator($q, $skip * 30, $from, $to);
            $paginate = $this->managementIndicatorInterface->countCallCenterManagementIndicators($q, $from, $to);
            $search = true;
        } else {
            $list     = $this->managementIndicatorInterface->listCallCenterManagementIndicators($skip * 30);
            $paginate = $this->managementIndicatorInterface->countCallCenterManagementIndicators('');
        }

        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $skip);

        return [
            'data' => [
                'managementIndicators'   => $list,
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

    public function saveManagementIndicator(array $data): bool
    {
        if (!array_key_exists('company_id', $data['data'])) {
            $data['data']['company_id'] = auth()->guard('managementIndicator')->user()->company_id;
        }

        $this->managementIndicatorInterface->createCallCenterManagementIndicator($data['data']);
        return true;
    }

    public function updateManagementIndicator(array $data): bool
    {
        $managementIndicator  = $this->managementIndicatorInterface->findCallCenterManagementIndicatorById($data['id']);
        $repo             = new CallCenterManagementIndicatorRepository($managementIndicator);
        $repo->updateCallCenterManagementIndicator($data['data']);
        return true;
    }

    public function deleteManagementIndicator(int $id): bool
    {
        $managementIndicator     = $this->managementIndicatorInterface->findCallCenterManagementIndicatorById($id);
        $managementIndicatorRepo = new CallCenterManagementIndicatorRepository($managementIndicator);
        $managementIndicatorRepo->deleteCallCenterManagementIndicator();
        return true;
    }
}
