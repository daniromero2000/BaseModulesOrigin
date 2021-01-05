<?php

namespace Modules\CallCenter\Entities\CommentManagements\Services;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\CallCenter\Entities\CommentManagements\Repositories\Interfaces\CallCenterCommentManagementRepositoryInterface;
use Modules\CallCenter\Entities\CommentManagements\Repositories\CallCenterCommentManagementRepository;
use Modules\CallCenter\Entities\CommentManagements\Services\Interfaces\CallCenterCommentManagementServiceInterface;
use Carbon\Carbon;

class CallCenterCommentManagementService implements CallCenterCommentManagementServiceInterface
{
    protected $commentManagementInterface, $toolsInterface;

    public function __construct(
        CallCenterCommentManagementRepositoryInterface $commentManagementRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->commentManagementInterface = $commentManagementRepositoryInterface;
        $this->toolsInterface           = $toolRepositoryInterface;
    }

    public function listCommentManagements(array $data): array
    {
        $skip        = array_key_exists('skip', $data['search']) ? $data['search']['skip'] : 0;
        $fromOrigin  = array_key_exists('from', $data['search']) ? $data['search']['from'] . " 00:00:01" : '';
        $toOrigin    = array_key_exists('to', $data['search']) ? $data['search']['to'] . " 23:59:59" : '';
        $q           = array_key_exists('q', $data['search']) ? $data['search']['q'] : '';
        $search      = false;

        if ($q != '' && ($fromOrigin == '' || $toOrigin == '')) {
            $list     = $this->commentManagementInterface->searchCallCenterCommentManagement($q, $skip * 30);
            $paginate = $this->commentManagementInterface->countCallCenterCommentManagements($q, '');
            $search = true;
        } elseif (($q != '' || $fromOrigin != '' || $toOrigin != '')) {
            $from     = $fromOrigin != '' ? $fromOrigin : Carbon::now()->subMonths(1);
            $to       = $toOrigin != '' ? $toOrigin : Carbon::now();
            $list     = $this->commentManagementInterface->searchCallCenterCommentManagement($q, $skip * 30, $from, $to);
            $paginate = $this->commentManagementInterface->countCallCenterCommentManagements($q, $from, $to);
            $search = true;
        } else {
            $list     = $this->commentManagementInterface->listCallCenterCommentManagements($skip * 30);
            $paginate = $this->commentManagementInterface->countCallCenterCommentManagements('');
        }

        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $skip);

        return [
            'data' => [
                'commentManagements'   => $list,
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

    public function saveCommentManagement(array $data): bool
    {
        if (!array_key_exists('company_id', $data['data'])) {
            $data['data']['company_id'] = auth()->guard('commentManagement')->user()->company_id;
        }

        $this->commentManagementInterface->createCallCenterCommentManagement($data['data']);
        return true;
    }

    public function updateCommentManagement(array $data): bool
    {
        $commentManagement  = $this->commentManagementInterface->findCallCenterCommentManagementById($data['id']);
        $repo             = new CallCenterCommentManagementRepository($commentManagement);
        $repo->updateCallCenterCommentManagement($data['data']);
        return true;
    }

    public function deleteCommentManagement(int $id): bool
    {
        $commentManagement     = $this->commentManagementInterface->findCallCenterCommentManagementById($id);
        $commentManagementRepo = new CallCenterCommentManagementRepository($commentManagement);
        $commentManagementRepo->deleteCallCenterCommentManagement();
        return true;
    }
}
