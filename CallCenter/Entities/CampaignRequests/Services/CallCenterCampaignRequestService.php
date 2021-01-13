<?php

namespace Modules\CallCenter\Entities\CampaignRequests\Services;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\CallCenter\Entities\CampaignRequests\Repositories\Interfaces\CallCenterCampaignRequestRepositoryInterface;
use Modules\CallCenter\Entities\CampaignRequests\Repositories\CallCenterCampaignRequestRepository;
use Modules\CallCenter\Entities\CampaignRequests\Services\Interfaces\CallCenterCampaignRequestServiceInterface;
use Carbon\Carbon;

class CallCenterCampaignRequestService implements CallCenterCampaignRequestServiceInterface
{
    protected $campaignRequestInterface, $toolsInterface;

    public function __construct(
        CallCenterCampaignRequestRepositoryInterface $campaignRequestRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->campaignRequestInterface = $campaignRequestRepositoryInterface;
        $this->toolsInterface           = $toolRepositoryInterface;
    }

    public function listCampaignRequests(array $data): array
    {
        $skip        = array_key_exists('skip', $data['search']) ? $data['search']['skip'] : 0;
        $fromOrigin  = array_key_exists('from', $data['search']) ? $data['search']['from'] . " 00:00:01" : '';
        $toOrigin    = array_key_exists('to', $data['search']) ? $data['search']['to'] . " 23:59:59" : '';
        $q           = array_key_exists('q', $data['search']) ? $data['search']['q'] : '';
        $search      = false;

        if ($q != '' && ($fromOrigin == '' || $toOrigin == '')) {
            $list     = $this->campaignRequestInterface->searchCallCenterCampaignRequest($q, $skip * 30);
            $paginate = $this->campaignRequestInterface->countCallCenterCampaignRequests($q);
            $search = true;
        } elseif (($q != '' || $fromOrigin != '' || $toOrigin != '')) {
            $from     = $fromOrigin != '' ? $fromOrigin : Carbon::now()->subMonths(1);
            $to       = $toOrigin != '' ? $toOrigin : Carbon::now();
            $list     = $this->campaignRequestInterface->searchCallCenterCampaignRequest($q, $skip * 30, $from, $to);
            $paginate = $this->campaignRequestInterface->countCallCenterCampaignRequests($q, $from, $to);
            $search = true;
        } else {
            $list     = $this->campaignRequestInterface->listCallCenterCampaignRequests($skip * 30);
            $paginate = $this->campaignRequestInterface->countCallCenterCampaignRequests('');
        }

        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $skip);

        $list = $list->map(function ($item) {
            $item->employee_id = $item->employee->name . ' ' . $item->employee->last_name;

            if ($item->status == 0) {
                $item->status = ['status' => 'Pendiente', 'color' => '#FFFFFF', 'background' => '#007bff'];
            } elseif ($item->status == 1) {
                $item->status = ['status' => 'Aprobado', 'color' => '#FFFFFF', 'background' => '#007bff'];
            } else {
                $item->status = ['status' => 'Negado', 'color' => '#FFFFFF', 'background' => '#007bff'];
            }
            $item->status = collect($item->status);
            return $item;
        })->all();

        return [
            'data' => [
                'list'               => collect($list),
                'optionsRoutes'      => 'admin.' . (request()->segment(2)),
                'headers'            => ['Solicitante', 'Campaña', 'Estado', 'Descripción', 'Ver', 'Opciones'],
                'searchInputs'       => [
                    ['label' => 'Buscar', 'type' => 'text', 'name' => 'q'],
                    ['label' => 'Desde', 'type' => 'date', 'name' => 'from'],
                    ['label' => 'Hasta', 'type' => 'date', 'name' => 'to']
                ],
                'inputs' => [
                    ['label' => 'Campaña', 'type' => 'text', 'name' => 'campaign'],
                    ['label' => 'Estado', 'type' => 'select', 'name' => 'status', 'options' => [
                        ['id' => '1', 'name' => 'Aprobado'],
                        ['id' => '0', 'name' => 'Pendiente'],
                        ['id' => '2', 'name' => 'Negado']
                    ], 'option' => 'name']
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

    public function saveCampaignRequest($data): bool
    {
        $data['employee_id'] = auth()->guard('employee')->user()->id;
        $this->campaignRequestInterface->createCallCenterCampaignRequest($data);
        return true;
    }

    public function saveFileCampaignRequest($data)
    {
        return $this->campaignRequestInterface->saveDocumentFile($data);
    }

    public function getCreate($data): array
    {

        return [];
    }

    public function getShow(int $id): array
    {
        $item = $this->campaignRequestInterface->findCallCenterCampaignRequestById($id);

        $item->employee_id = $item->employee->name . ' ' . $item->employee->last_name;

        if ($item->status == 0) {
            $item->status = ['status' => 'Pendiente', 'color' => '#FFFFFF', 'background' => '#007bff'];
        } elseif ($item->status == 1) {
            $item->status = ['status' => 'Aprobado', 'color' => '#FFFFFF', 'background' => '#007bff'];
        } else {
            $item->status = ['status' => 'Negado', 'color' => '#FFFFFF', 'background' => '#007bff'];
        }
        $item->status = collect($item->status);

        return [
            'data'          => $item,
            'inputs'        => [
                ['label' => 'Campaña', 'type' => 'text', 'name' => 'campaign'],
            ],
            'optionsRoutes' => 'admin.' . (request()->segment(2)),
        ];
    }

    public function downloadFileCampaignRequest($id)
    {
        $file = $this->campaignRequestInterface->findCallCenterCampaignRequestById($id);
        $exten = explode(".", $file->src);
        return [
            'file' => "storage/" . $file->src,
            'name' => $file->campaign . '.' . $exten[1]
        ];
    }

    public function updateCampaignRequest(array $data): bool
    {
        $campaignRequest  = $this->campaignRequestInterface->findCallCenterCampaignRequestById($data['id']);
        $repo             = new CallCenterCampaignRequestRepository($campaignRequest);
        $repo->updateCallCenterCampaignRequest($data['data']);
        return true;
    }

    public function deleteCampaignRequest(int $id): bool
    {
        $campaignRequest     = $this->campaignRequestInterface->findCallCenterCampaignRequestById($id);
        $campaignRequestRepo = new CallCenterCampaignRequestRepository($campaignRequest);
        $campaignRequestRepo->deleteCallCenterCampaignRequest();
        return true;
    }
}
