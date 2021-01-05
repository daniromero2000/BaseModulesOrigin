<?php

namespace Modules\CallCenter\Entities\ProductInterestComments\Services;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\CallCenter\Entities\ProductInterestComments\Repositories\Interfaces\CallCenterProductInterestCommentRepositoryInterface;
use Modules\CallCenter\Entities\ProductInterestComments\Repositories\CallCenterProductInterestCommentRepository;
use Modules\CallCenter\Entities\ProductInterestComments\Services\Interfaces\CallCenterProductInterestCommentServiceInterface;
use Carbon\Carbon;

class CallCenterProductInterestCommentService implements CallCenterProductInterestCommentServiceInterface
{
    protected $productInterestCommentInterface, $toolsInterface;

    public function __construct(
        CallCenterProductInterestCommentRepositoryInterface $productInterestCommentRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->productInterestCommentInterface = $productInterestCommentRepositoryInterface;
        $this->toolsInterface           = $toolRepositoryInterface;
    }

    public function listProductInterestComments(array $data): array
    {
        $skip        = array_key_exists('skip', $data['search']) ? $data['search']['skip'] : 0;
        $fromOrigin  = array_key_exists('from', $data['search']) ? $data['search']['from'] . " 00:00:01" : '';
        $toOrigin    = array_key_exists('to', $data['search']) ? $data['search']['to'] . " 23:59:59" : '';
        $q           = array_key_exists('q', $data['search']) ? $data['search']['q'] : '';
        $search      = false;

        if ($q != '' && ($fromOrigin == '' || $toOrigin == '')) {
            $list     = $this->productInterestCommentInterface->searchCallCenterProductInterestComment($q, $skip * 30);
            $paginate = $this->productInterestCommentInterface->countCallCenterProductInterestComments($q, '');
            $search = true;
        } elseif (($q != '' || $fromOrigin != '' || $toOrigin != '')) {
            $from     = $fromOrigin != '' ? $fromOrigin : Carbon::now()->subMonths(1);
            $to       = $toOrigin != '' ? $toOrigin : Carbon::now();
            $list     = $this->productInterestCommentInterface->searchCallCenterProductInterestComment($q, $skip * 30, $from, $to);
            $paginate = $this->productInterestCommentInterface->countCallCenterProductInterestComments($q, $from, $to);
            $search = true;
        } else {
            $list     = $this->productInterestCommentInterface->listCallCenterProductInterestComments($skip * 30);
            $paginate = $this->productInterestCommentInterface->countCallCenterProductInterestComments('');
        }

        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $skip);

        return [
            'data' => [
                'productInterestComments'   => $list,
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

    public function saveProductInterestComment(array $data): bool
    {
        if (!array_key_exists('company_id', $data['data'])) {
            $data['data']['company_id'] = auth()->guard('productInterestComment')->user()->company_id;
        }

        $this->productInterestCommentInterface->createCallCenterProductInterestComment($data['data']);
        return true;
    }

    public function updateProductInterestComment(array $data): bool
    {
        $productInterestComment  = $this->productInterestCommentInterface->findCallCenterProductInterestCommentById($data['id']);
        $repo             = new CallCenterProductInterestCommentRepository($productInterestComment);
        $repo->updateCallCenterProductInterestComment($data['data']);
        return true;
    }

    public function deleteProductInterestComment(int $id): bool
    {
        $productInterestComment     = $this->productInterestCommentInterface->findCallCenterProductInterestCommentById($id);
        $productInterestCommentRepo = new CallCenterProductInterestCommentRepository($productInterestComment);
        $productInterestCommentRepo->deleteCallCenterProductInterestComment();
        return true;
    }
}
