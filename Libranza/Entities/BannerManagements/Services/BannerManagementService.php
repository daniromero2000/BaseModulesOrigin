<?php

namespace Modules\Libranza\Entities\BannerManagements\Services;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Libranza\Entities\BannerManagements\Repositories\Interfaces\BannerManagementRepositoryInterface;
use Modules\Libranza\Entities\BannerManagements\Repositories\BannerManagementRepository;
use Modules\Libranza\Entities\BannerManagements\Services\Interfaces\BannerManagementServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;


class BannerManagementService implements BannerManagementServiceInterface
{
    protected $managementInterface, $toolsInterface;

    public function __construct(
        BannerManagementRepositoryInterface $managementRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->managementInterface = $managementRepositoryInterface;
        $this->toolsInterface      = $toolRepositoryInterface;
    }

    public function listManagements(array $data): array
    {
        $skip        = array_key_exists('skip', $data['search']) ? $data['search']['skip'] : 0;
        $fromOrigin  = array_key_exists('from', $data['search']) ? $data['search']['from'] . " 00:00:01" : '';
        $toOrigin    = array_key_exists('to', $data['search']) ? $data['search']['to'] . " 23:59:59" : '';
        $q           = array_key_exists('q', $data['search']) ? $data['search']['q'] : '';
        $search      = false;

        if ($q != '' && ($fromOrigin == '' || $toOrigin == '')) {
            $list     = $this->managementInterface->searchBannerManagement($q, $skip * 30);
            $paginate = $this->managementInterface->countBannerManagements($q, '');
            $search = true;
        } elseif (($q != '' || $fromOrigin != '' || $toOrigin != '')) {
            $from     = $fromOrigin != '' ? $fromOrigin : Carbon::now()->subMonths(1);
            $to       = $toOrigin != '' ? $toOrigin : Carbon::now();
            $list     = $this->managementInterface->searchBannerManagement($q, $skip * 30, $from, $to);
            $paginate = $this->managementInterface->countBannerManagements($q, $from, $to);
            $search = true;
        } else {
            $list     = $this->managementInterface->listBannerManagements($skip * 30);
            $paginate = $this->managementInterface->countBannerManagements('');
        }

        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $skip);

        return [
            'data' => [
                'categories'   => $list,
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

    public function listFront()
    {
        return $this->managementInterface->listBannerManagementsForFront();
    }

    public function saveManagement(array $data): bool
    {
        if ($data['image'] instanceof UploadedFile) {
            $img = $this->managementInterface->saveImage(['image' => $data['image'], 'name' =>  $data['data']['name']]);
        }

        $data['data']['src'] =  $img;
        $data['data']['alt'] =  str_slug($data['data']['alt']);

        $this->managementInterface->createBannerManagement($data['data']);


        return true;
    }

    public function showManagement(int $id)
    {
        return  $this->managementInterface->findBannerManagementById($id);
    }

    public function updateManagement(array $data): bool
    {
        if (array_key_exists('image', $data) && $data['image'] instanceof UploadedFile) {
            $img = $this->managementInterface->saveImage(['image' => $data['image'], 'name' =>  $data['data']['name']]);
            $data['data']['src'] =  $img;
        }

        $management  = $this->managementInterface->findBannerManagementById($data['id']);
        $repo        = new BannerManagementRepository($management);
        $repo->updateBannerManagement($data['data']);
        return true;
    }

    public function updateSortOrder($data): bool
    {
        foreach ($data as $key => $value) {
            $this->managementInterface->updateSortOrder($value);
        }
        return true;
    }

    public function deleteManagement(int $id): bool
    {
        $management     = $this->managementInterface->findBannerManagementById($id);
        $managementRepo = new BannerManagementRepository($management);
        $managementRepo->deleteBannerManagement();
        return true;
    }
}
