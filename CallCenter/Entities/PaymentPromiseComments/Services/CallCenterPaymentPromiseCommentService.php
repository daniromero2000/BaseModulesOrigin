<?php

namespace Modules\CallCenter\Entities\PaymentPromiseComments\Services;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\CallCenter\Entities\PaymentPromiseComments\Repositories\Interfaces\CallCenterPaymentPromiseCommentRepositoryInterface;
use Modules\CallCenter\Entities\PaymentPromiseComments\Repositories\CallCenterPaymentPromiseCommentRepository;
use Modules\CallCenter\Entities\PaymentPromiseComments\Services\Interfaces\CallCenterPaymentPromiseCommentServiceInterface;
use Carbon\Carbon;

class CallCenterPaymentPromiseCommentService implements CallCenterPaymentPromiseCommentServiceInterface
{
    protected $paymentPromiseCommentInterface, $toolsInterface;

    public function __construct(
        CallCenterPaymentPromiseCommentRepositoryInterface $paymentPromiseCommentRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->paymentPromiseCommentInterface = $paymentPromiseCommentRepositoryInterface;
        $this->toolsInterface           = $toolRepositoryInterface;
    }

    public function listPaymentPromiseComments(array $data): array
    {
        $skip        = array_key_exists('skip', $data['search']) ? $data['search']['skip'] : 0;
        $fromOrigin  = array_key_exists('from', $data['search']) ? $data['search']['from'] . " 00:00:01" : '';
        $toOrigin    = array_key_exists('to', $data['search']) ? $data['search']['to'] . " 23:59:59" : '';
        $q           = array_key_exists('q', $data['search']) ? $data['search']['q'] : '';
        $search      = false;

        if ($q != '' && ($fromOrigin == '' || $toOrigin == '')) {
            $list     = $this->paymentPromiseCommentInterface->searchCallCenterPaymentPromiseComment($q, $skip * 30);
            $paginate = $this->paymentPromiseCommentInterface->countCallCenterPaymentPromiseComments($q, '');
            $search = true;
        } elseif (($q != '' || $fromOrigin != '' || $toOrigin != '')) {
            $from     = $fromOrigin != '' ? $fromOrigin : Carbon::now()->subMonths(1);
            $to       = $toOrigin != '' ? $toOrigin : Carbon::now();
            $list     = $this->paymentPromiseCommentInterface->searchCallCenterPaymentPromiseComment($q, $skip * 30, $from, $to);
            $paginate = $this->paymentPromiseCommentInterface->countCallCenterPaymentPromiseComments($q, $from, $to);
            $search = true;
        } else {
            $list     = $this->paymentPromiseCommentInterface->listCallCenterPaymentPromiseComments($skip * 30);
            $paginate = $this->paymentPromiseCommentInterface->countCallCenterPaymentPromiseComments('');
        }

        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $skip);

        return [
            'data' => [
                'paymentPromiseComments'   => $list,
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

    public function savePaymentPromiseComment(array $data): bool
    {
        if (!array_key_exists('company_id', $data['data'])) {
            $data['data']['company_id'] = auth()->guard('paymentPromiseComment')->user()->company_id;
        }

        $this->paymentPromiseCommentInterface->createCallCenterPaymentPromiseComment($data['data']);
        return true;
    }

    public function updatePaymentPromiseComment(array $data): bool
    {
        $paymentPromiseComment  = $this->paymentPromiseCommentInterface->findCallCenterPaymentPromiseCommentById($data['id']);
        $repo             = new CallCenterPaymentPromiseCommentRepository($paymentPromiseComment);
        $repo->updateCallCenterPaymentPromiseComment($data['data']);
        return true;
    }

    public function deletePaymentPromiseComment(int $id): bool
    {
        $paymentPromiseComment     = $this->paymentPromiseCommentInterface->findCallCenterPaymentPromiseCommentById($id);
        $paymentPromiseCommentRepo = new CallCenterPaymentPromiseCommentRepository($paymentPromiseComment);
        $paymentPromiseCommentRepo->deleteCallCenterPaymentPromiseComment();
        return true;
    }
}
