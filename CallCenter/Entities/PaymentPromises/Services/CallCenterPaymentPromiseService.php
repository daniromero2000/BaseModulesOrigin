<?php

namespace Modules\CallCenter\Entities\PaymentPromises\Services;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\CallCenter\Entities\PaymentPromises\Repositories\Interfaces\CallCenterPaymentPromiseRepositoryInterface;
use Modules\CallCenter\Entities\PaymentPromises\Repositories\CallCenterPaymentPromiseRepository;
use Modules\CallCenter\Entities\PaymentPromises\Services\Interfaces\CallCenterPaymentPromiseServiceInterface;
use Carbon\Carbon;

class CallCenterPaymentPromiseService implements CallCenterPaymentPromiseServiceInterface
{
    protected $campaignRequestInterface, $toolsInterface;

    public function __construct(
        CallCenterPaymentPromiseRepositoryInterface $campaignRequestRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->campaignRequestInterface = $campaignRequestRepositoryInterface;
        $this->toolsInterface           = $toolRepositoryInterface;
    }

    public function listPaymentPromises(array $data): array
    {
        $skip        = array_key_exists('skip', $data['search']) ? $data['search']['skip'] : 0;
        $fromOrigin  = array_key_exists('from', $data['search']) ? $data['search']['from'] . " 00:00:01" : '';
        $toOrigin    = array_key_exists('to', $data['search']) ? $data['search']['to'] . " 23:59:59" : '';
        $q           = array_key_exists('q', $data['search']) ? $data['search']['q'] : '';
        $search      = false;

        if ($q != '' && ($fromOrigin == '' || $toOrigin == '')) {
            $list     = $this->campaignRequestInterface->searchCallCenterPaymentPromise($q, $skip * 30);
            $paginate = $this->campaignRequestInterface->countCallCenterPaymentPromises($q, '');
            $search = true;
        } elseif (($q != '' || $fromOrigin != '' || $toOrigin != '')) {
            $from     = $fromOrigin != '' ? $fromOrigin : Carbon::now()->subMonths(1);
            $to       = $toOrigin != '' ? $toOrigin : Carbon::now();
            $list     = $this->campaignRequestInterface->searchCallCenterPaymentPromise($q, $skip * 30, $from, $to);
            $paginate = $this->campaignRequestInterface->countCallCenterPaymentPromises($q, $from, $to);
            $search = true;
        } else {
            $list     = $this->campaignRequestInterface->listCallCenterPaymentPromises($skip * 30);
            $paginate = $this->campaignRequestInterface->countCallCenterPaymentPromises('');
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

    public function savePaymentPromise(array $data): bool
    {
        if (!array_key_exists('company_id', $data['data'])) {
            $data['data']['company_id'] = auth()->guard('campaignRequest')->user()->company_id;
        }

        $this->campaignRequestInterface->createCallCenterPaymentPromise($data['data']);
        return true;
    }

    public function updatePaymentPromise(array $data): bool
    {
        $campaignRequest  = $this->campaignRequestInterface->findCallCenterPaymentPromiseById($data['id']);
        $repo             = new CallCenterPaymentPromiseRepository($campaignRequest);
        $repo->updateCallCenterPaymentPromise($data['data']);
        return true;
    }

    public function deletePaymentPromise(int $id): bool
    {
        $campaignRequest     = $this->campaignRequestInterface->findCallCenterPaymentPromiseById($id);
        $campaignRequestRepo = new CallCenterPaymentPromiseRepository($campaignRequest);
        $campaignRequestRepo->deleteCallCenterPaymentPromise();
        return true;
    }
}
