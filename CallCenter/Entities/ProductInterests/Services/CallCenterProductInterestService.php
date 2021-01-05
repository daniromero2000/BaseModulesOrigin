<?php

namespace Modules\CallCenter\Entities\ProductInterests\Services;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\CallCenter\Entities\ProductInterests\Repositories\Interfaces\CallCenterProductInterestRepositoryInterface;
use Modules\CallCenter\Entities\ProductInterests\Repositories\CallCenterProductInterestRepository;
use Modules\CallCenter\Entities\ProductInterests\Services\Interfaces\CallCenterProductInterestServiceInterface;
use Carbon\Carbon;

class CallCenterProductInterestService implements CallCenterProductInterestServiceInterface
{
    protected $productInterestInterface, $toolsInterface;

    public function __construct(
        CallCenterProductInterestRepositoryInterface $productInterestRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->productInterestInterface = $productInterestRepositoryInterface;
        $this->toolsInterface           = $toolRepositoryInterface;
    }

    public function listProductInterests(array $data): array
    {
        $skip        = array_key_exists('skip', $data['search']) ? $data['search']['skip'] : 0;
        $fromOrigin  = array_key_exists('from', $data['search']) ? $data['search']['from'] . " 00:00:01" : '';
        $toOrigin    = array_key_exists('to', $data['search']) ? $data['search']['to'] . " 23:59:59" : '';
        $q           = array_key_exists('q', $data['search']) ? $data['search']['q'] : '';
        $search      = false;

        if ($q != '' && ($fromOrigin == '' || $toOrigin == '')) {
            $list     = $this->productInterestInterface->searchCallCenterProductInterest($q, $skip * 30);
            $paginate = $this->productInterestInterface->countCallCenterProductInterests($q, '');
            $search = true;
        } elseif (($q != '' || $fromOrigin != '' || $toOrigin != '')) {
            $from     = $fromOrigin != '' ? $fromOrigin : Carbon::now()->subMonths(1);
            $to       = $toOrigin != '' ? $toOrigin : Carbon::now();
            $list     = $this->productInterestInterface->searchCallCenterProductInterest($q, $skip * 30, $from, $to);
            $paginate = $this->productInterestInterface->countCallCenterProductInterests($q, $from, $to);
            $search = true;
        } else {
            $list     = $this->productInterestInterface->listCallCenterProductInterests($skip * 30);
            $paginate = $this->productInterestInterface->countCallCenterProductInterests('');
        }

        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $skip);

        return [
            'data' => [
                'productInterests'   => $list,
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

    public function saveProductInterest(array $data): bool
    {
        if (!array_key_exists('company_id', $data['data'])) {
            $data['data']['company_id'] = auth()->guard('productInterest')->user()->company_id;
        }

        $this->productInterestInterface->createCallCenterProductInterest($data['data']);
        return true;
    }

    public function updateProductInterest(array $data): bool
    {
        $productInterest  = $this->productInterestInterface->findCallCenterProductInterestById($data['id']);
        $repo             = new CallCenterProductInterestRepository($productInterest);
        $repo->updateCallCenterProductInterest($data['data']);
        return true;
    }

    public function deleteProductInterest(int $id): bool
    {
        $productInterest     = $this->productInterestInterface->findCallCenterProductInterestById($id);
        $productInterestRepo = new CallCenterProductInterestRepository($productInterest);
        $productInterestRepo->deleteCallCenterProductInterest();
        return true;
    }
}
