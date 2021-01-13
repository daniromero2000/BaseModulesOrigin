<?php

namespace Modules\CallCenter\Entities\Scripts\Services;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\CallCenter\Entities\Scripts\Repositories\Interfaces\CallCenterScriptRepositoryInterface;
use Modules\CallCenter\Entities\Scripts\Repositories\CallCenterScriptRepository;
use Modules\CallCenter\Entities\Scripts\Services\Interfaces\CallCenterScriptServiceInterface;
use Carbon\Carbon;

class CallCenterScriptService implements CallCenterScriptServiceInterface
{
    protected $scriptRequestInterface, $toolsInterface;

    public function __construct(
        CallCenterScriptRepositoryInterface $scriptRequestRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->scriptRequestInterface = $scriptRequestRepositoryInterface;
        $this->toolsInterface         = $toolRepositoryInterface;
    }

    public function listScripts(array $data): array
    {
        $skip        = array_key_exists('skip', $data['search']) ? $data['search']['skip'] : 0;
        $fromOrigin  = array_key_exists('from', $data['search']) ? $data['search']['from'] . " 00:00:01" : '';
        $toOrigin    = array_key_exists('to', $data['search']) ? $data['search']['to'] . " 23:59:59" : '';
        $q           = array_key_exists('q', $data['search']) ? $data['search']['q'] : '';
        $search      = false;

        if ($q != '' && ($fromOrigin == '' || $toOrigin == '')) {
            $list     = $this->scriptRequestInterface->searchCallCenterScript($q, $skip * 30);
            $paginate = $this->scriptRequestInterface->countCallCenterScripts($q, '');
            $search = true;
        } elseif (($q != '' || $fromOrigin != '' || $toOrigin != '')) {
            $from     = $fromOrigin != '' ? $fromOrigin : Carbon::now()->subMonths(1);
            $to       = $toOrigin != '' ? $toOrigin : Carbon::now();
            $list     = $this->scriptRequestInterface->searchCallCenterScript($q, $skip * 30, $from, $to);
            $paginate = $this->scriptRequestInterface->countCallCenterScripts($q, $from, $to);
            $search = true;
        } else {
            $list     = $this->scriptRequestInterface->listCallCenterScripts($skip * 30);
            $paginate = $this->scriptRequestInterface->countCallCenterScripts('');
        }

        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $skip);

        return [
            'data' => [
                'list'               => $list,
                'optionsRoutes'      => 'admin.' . (request()->segment(2)),
                'headers'            => ['Nombre', 'Guion', 'Opciones'],
                'searchInputs'       => [
                    ['label' => 'Buscar', 'type' => 'text', 'name' => 'q'],
                    ['label' => 'Desde', 'type' => 'date', 'name' => 'from'],
                    ['label' => 'Hasta', 'type' => 'date', 'name' => 'to']
                ],
                'inputs' => [
                    ['label' => 'Nombre', 'type' => 'text', 'name' => 'name'],
                    ['label' => 'Guion', 'type' => 'textarea', 'name' => 'script']
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

    public function saveScript(array $data): bool
    {
        $this->scriptRequestInterface->createCallCenterScript($data);
        return true;
    }

    public function updateScript(array $data): bool
    {
        $scriptRequest  = $this->scriptRequestInterface->findCallCenterScriptById($data['id']);
        $repo           = new CallCenterScriptRepository($scriptRequest);
        $repo->updateCallCenterScript($data['data']);
        return true;
    }

    public function deleteScript(int $id): bool
    {
        $scriptRequest     = $this->scriptRequestInterface->findCallCenterScriptById($id);
        $scriptRequestRepo = new CallCenterScriptRepository($scriptRequest);
        $scriptRequestRepo->deleteCallCenterScript();
        return true;
    }
}
