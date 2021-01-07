<?php

namespace Modules\CallCenter\Entities\CampaignBases\Services;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\CallCenter\Entities\CampaignBases\Repositories\Interfaces\CallCenterCampaignBaseRepositoryInterface;
use Modules\CallCenter\Entities\CampaignBases\Repositories\CallCenterCampaignBaseRepository;
use Modules\CallCenter\Entities\CampaignBases\Services\Interfaces\CallCenterCampaignBaseServiceInterface;
use Carbon\Carbon;

class CallCenterCampaignBaseService implements CallCenterCampaignBaseServiceInterface
{
    protected $campaignBaseInterface, $toolsInterface;

    public function __construct(
        CallCenterCampaignBaseRepositoryInterface $campaignBaseRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->campaignBaseInterface = $campaignBaseRepositoryInterface;
        $this->toolsInterface        = $toolRepositoryInterface;
    }

    public function listCampaignBases(array $data): array
    {
        $skip        = array_key_exists('skip', $data['search']) ? $data['search']['skip'] : 0;
        $fromOrigin  = array_key_exists('from', $data['search']) ? $data['search']['from'] . " 00:00:01" : '';
        $toOrigin    = array_key_exists('to', $data['search']) ? $data['search']['to'] . " 23:59:59" : '';
        $q           = array_key_exists('q', $data['search']) ? $data['search']['q'] : '';
        $search      = false;

        if ($q != '' && ($fromOrigin == '' || $toOrigin == '')) {
            $list     = $this->campaignBaseInterface->searchCallCenterCampaignBase($q, $skip * 30);
            $paginate = $this->campaignBaseInterface->countCallCenterCampaignBases($q, '');
            $search = true;
        } elseif (($q != '' || $fromOrigin != '' || $toOrigin != '')) {
            $from     = $fromOrigin != '' ? $fromOrigin : Carbon::now()->subMonths(1);
            $to       = $toOrigin != '' ? $toOrigin : Carbon::now();
            $list     = $this->campaignBaseInterface->searchCallCenterCampaignBase($q, $skip * 30, $from, $to);
            $paginate = $this->campaignBaseInterface->countCallCenterCampaignBases($q, $from, $to);
            $search = true;
        } else {
            $list     = $this->campaignBaseInterface->listCallCenterCampaignBases($skip * 30);
            $paginate = $this->campaignBaseInterface->countCallCenterCampaignBases('');
        }

        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $skip);

        return [
            'data' => [
                'campaignBases'   => $list,
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

    public function saveCampaignBase(array $data): bool
    {
        if (!array_key_exists('company_id', $data['data'])) {
            $data['data']['company_id'] = auth()->guard('campaignBase')->user()->company_id;
        }

        $this->campaignBaseInterface->createCallCenterCampaignBase($data['data']);
        return true;
    }

    public function updateCampaignBase(array $data): bool
    {
        $campaignBase  = $this->campaignBaseInterface->findCallCenterCampaignBaseById($data['id']);
        $repo             = new CallCenterCampaignBaseRepository($campaignBase);
        $repo->updateCallCenterCampaignBase($data['data']);
        return true;
    }

    public function deleteCampaignBase(int $id): bool
    {
        $campaignBase     = $this->campaignBaseInterface->findCallCenterCampaignBaseById($id);
        $campaignBaseRepo = new CallCenterCampaignBaseRepository($campaignBase);
        $campaignBaseRepo->deleteCallCenterCampaignBase();
        return true;
    }
}
