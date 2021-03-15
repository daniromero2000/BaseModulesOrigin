<?php

namespace Modules\Libranza\Entities\Subscriptions\Services;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Libranza\Entities\Subscriptions\Repositories\Interfaces\SubscriptionRepositoryInterface;
use Modules\Libranza\Entities\Subscriptions\Repositories\SubscriptionRepository;
use Modules\Libranza\Entities\Subscriptions\Services\Interfaces\SubscriptionServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;


class SubscriptionService implements SubscriptionServiceInterface
{
    protected $subscriptionsInterface, $toolsInterface;

    public function __construct(
        SubscriptionRepositoryInterface $subscriptionsRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->subscriptionsInterface = $subscriptionsRepositoryInterface;
        $this->toolsInterface      = $toolRepositoryInterface;
    }

    public function listSubscriptions(array $data): array
    {
        $skip        = array_key_exists('skip', $data['search']) ? $data['search']['skip'] : 0;
        $fromOrigin  = array_key_exists('from', $data['search']) ? $data['search']['from'] . " 00:00:01" : '';
        $toOrigin    = array_key_exists('to', $data['search']) ? $data['search']['to'] . " 23:59:59" : '';
        $q           = array_key_exists('q', $data['search']) ? $data['search']['q'] : '';
        $search      = false;

        if ($q != '' && ($fromOrigin == '' || $toOrigin == '')) {
            $list     = $this->subscriptionsInterface->searchSubscription($q, $skip * 30);
            $paginate = $this->subscriptionsInterface->countSubscriptions($q, '');
            $search = true;
        } elseif (($q != '' || $fromOrigin != '' || $toOrigin != '')) {
            $from     = $fromOrigin != '' ? $fromOrigin : Carbon::now()->subMonths(1);
            $to       = $toOrigin != '' ? $toOrigin : Carbon::now();
            $list     = $this->subscriptionsInterface->searchSubscription($q, $skip * 30, $from, $to);
            $paginate = $this->subscriptionsInterface->countSubscriptions($q, $from, $to);
            $search = true;
        } else {
            $list     = $this->subscriptionsInterface->listSubscriptions($skip * 30);
            $paginate = $this->subscriptionsInterface->countSubscriptions('');
        }

        $list = $list->map(function ($item) {
            $item->post_id         = $item->post->title;
            return $item;
        })->all();


        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $skip);

        return [
            'data' => [
                'list'   => collect($list),
                'optionsRoutes'      => 'admin.' . (request()->segment(2)),
                'headers'            => ['Nombre', 'Apellidos', 'Correo', 'Teléfono', 'Post'],
                'title'              => 'Suscripciones',
                'routeEdit'         => 'admin.' . (request()->segment(2)) . '.edit',
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

    public function listFront()
    {
        return $this->subscriptionsInterface->listSubscriptionsForFront();
    }

    public function saveSubscription(array $data): bool
    {
        $this->subscriptionsInterface->createSubscription($data['data']);

        return true;
    }

    public function showSubscription(int $id)
    {
        return  $this->subscriptionsInterface->findSubscriptionById($id);
    }

    public function updateSubscription(array $data): bool
    {

        $subscriptions  = $this->subscriptionsInterface->findSubscriptionById($data['id']);
        $repo        = new SubscriptionRepository($subscriptions);
        $repo->updateSubscription($data['data']);
        return true;
    }

    public function updateSortOrder($data): bool
    {
        foreach ($data as $key => $value) {
            $this->subscriptionsInterface->updateSortOrder($value);
        }
        return true;
    }

    public function deleteSubscription(int $id): bool
    {
        $subscriptions     = $this->subscriptionsInterface->findSubscriptionById($id);
        $subscriptionsRepo = new SubscriptionRepository($subscriptions);
        $subscriptionsRepo->deleteSubscription();
        return true;
    }
}
