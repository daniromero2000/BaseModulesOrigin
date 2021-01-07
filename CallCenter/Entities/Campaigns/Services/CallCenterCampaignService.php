<?php

namespace Modules\CallCenter\Entities\Campaigns\Services;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\CallCenter\Entities\Campaigns\Repositories\Interfaces\CallCenterCampaignRepositoryInterface;
use Modules\CallCenter\Entities\Campaigns\Repositories\CallCenterCampaignRepository;
use Modules\CallCenter\Entities\Campaigns\Services\Interfaces\CallCenterCampaignServiceInterface;
use Carbon\Carbon;

class CallCenterCampaignService implements CallCenterCampaignServiceInterface
{
    protected $campaignInterface, $toolsInterface;

    public function __construct(
        CallCenterCampaignRepositoryInterface $campaignRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->campaignInterface = $campaignRepositoryInterface;
        $this->toolsInterface           = $toolRepositoryInterface;
    }

    public function listCampaigns(array $data): array
    {
        $skip        = array_key_exists('skip', $data['search']) ? $data['search']['skip'] : 0;
        $fromOrigin  = array_key_exists('from', $data['search']) ? $data['search']['from'] . " 00:00:01" : '';
        $toOrigin    = array_key_exists('to', $data['search']) ? $data['search']['to'] . " 23:59:59" : '';
        $q           = array_key_exists('q', $data['search']) ? $data['search']['q'] : '';
        $search      = false;

        if ($q != '' && ($fromOrigin == '' || $toOrigin == '')) {
            $list     = $this->campaignInterface->searchCallCenterCampaign($q, $skip * 30);
            $paginate = $this->campaignInterface->countCallCenterCampaigns($q, '');
            $search = true;
        } elseif (($q != '' || $fromOrigin != '' || $toOrigin != '')) {
            $from     = $fromOrigin != '' ? $fromOrigin : Carbon::now()->subMonths(1);
            $to       = $toOrigin != '' ? $toOrigin : Carbon::now();
            $list     = $this->campaignInterface->searchCallCenterCampaign($q, $skip * 30, $from, $to);
            $paginate = $this->campaignInterface->countCallCenterCampaigns($q, $from, $to);
            $search = true;
        } else {
            $list     = $this->campaignInterface->listCallCenterCampaigns($skip * 30);
            $paginate = $this->campaignInterface->countCallCenterCampaigns('');
        }

        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $skip);

        return [
            'data' => [
                'campaigns'   => $list,
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

    public function saveCampaign(array $data): bool
    {
        if (!array_key_exists('company_id', $data['data'])) {
            $data['data']['company_id'] = auth()->guard('campaign')->user()->company_id;
        }

        $this->campaignInterface->createCallCenterCampaign($data['data']);
        return true;
    }

    public function updateCampaign(array $data): bool
    {
        $campaign  = $this->campaignInterface->findCallCenterCampaignById($data['id']);
        $repo             = new CallCenterCampaignRepository($campaign);
        $repo->updateCallCenterCampaign($data['data']);
        return true;
    }

    public function deleteCampaign(int $id): bool
    {
        $campaign     = $this->campaignInterface->findCallCenterCampaignById($id);
        $campaignRepo = new CallCenterCampaignRepository($campaign);
        $campaignRepo->deleteCallCenterCampaign();
        return true;
    }
}
