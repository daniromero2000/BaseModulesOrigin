<?php

namespace Modules\CallCenter\Entities\CallQualifications\Services;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\CallCenter\Entities\CallQualifications\Repositories\Interfaces\CallCenterCallQualificationRepositoryInterface;
use Modules\CallCenter\Entities\CallQualifications\Repositories\CallCenterCallQualificationRepository;
use Modules\CallCenter\Entities\CallQualifications\Services\Interfaces\CallCenterCallQualificationServiceInterface;
use Carbon\Carbon;

class CallCenterCallQualificationService implements CallCenterCallQualificationServiceInterface
{
    protected $callQualificationInterface, $toolsInterface;

    public function __construct(
        CallCenterCallQualificationRepositoryInterface $callQualificationRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->callQualificationInterface = $callQualificationRepositoryInterface;
        $this->toolsInterface             = $toolRepositoryInterface;
    }

    public function listCallQualifications(array $data): array
    {
        $skip        = array_key_exists('skip', $data['search']) ? $data['search']['skip'] : 0;
        $fromOrigin  = array_key_exists('from', $data['search']) ? $data['search']['from'] . " 00:00:01" : '';
        $toOrigin    = array_key_exists('to', $data['search']) ? $data['search']['to'] . " 23:59:59" : '';
        $q           = array_key_exists('q', $data['search']) ? $data['search']['q'] : '';
        $search      = false;

        if ($q != '' && ($fromOrigin == '' || $toOrigin == '')) {
            $list     = $this->callQualificationInterface->searchCallCenterCallQualification($q, $skip * 30);
            $paginate = $this->callQualificationInterface->countCallCenterCallQualifications($q, '');
            $search = true;
        } elseif (($q != '' || $fromOrigin != '' || $toOrigin != '')) {
            $from     = $fromOrigin != '' ? $fromOrigin : Carbon::now()->subMonths(1);
            $to       = $toOrigin != '' ? $toOrigin : Carbon::now();
            $list     = $this->callQualificationInterface->searchCallCenterCallQualification($q, $skip * 30, $from, $to);
            $paginate = $this->callQualificationInterface->countCallCenterCallQualifications($q, $from, $to);
            $search = true;
        } else {
            $list     = $this->callQualificationInterface->listCallCenterCallQualifications($skip * 30);
            $paginate = $this->callQualificationInterface->countCallCenterCallQualifications('');
        }

        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $skip);

        return [
            'data' => [
                'callQualifications'   => $list,
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

    public function saveCallQualification(array $data): bool
    {
        if (!array_key_exists('company_id', $data['data'])) {
            $data['data']['company_id'] = auth()->guard('callQualification')->user()->company_id;
        }

        $this->callQualificationInterface->createCallCenterCallQualification($data['data']);
        return true;
    }

    public function updateCallQualification(array $data): bool
    {
        $callQualification  = $this->callQualificationInterface->findCallCenterCallQualificationById($data['id']);
        $repo             = new CallCenterCallQualificationRepository($callQualification);
        $repo->updateCallCenterCallQualification($data['data']);
        return true;
    }

    public function deleteCallQualification(int $id): bool
    {
        $callQualification     = $this->callQualificationInterface->findCallCenterCallQualificationById($id);
        $callQualificationRepo = new CallCenterCallQualificationRepository($callQualification);
        $callQualificationRepo->deleteCallCenterCallQualification();
        return true;
    }
}
