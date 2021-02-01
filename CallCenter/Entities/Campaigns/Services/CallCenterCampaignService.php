<?php

namespace Modules\CallCenter\Entities\Campaigns\Services;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\CallCenter\Entities\Campaigns\Repositories\Interfaces\CallCenterCampaignRepositoryInterface;
use Modules\CallCenter\Entities\Campaigns\Repositories\CallCenterCampaignRepository;
use Modules\CallCenter\Entities\Campaigns\Services\Interfaces\CallCenterCampaignServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;
use Modules\CallCenter\Entities\Questionnaires\Repositories\Interfaces\CallCenterQuestionnaireRepositoryInterface;
use Modules\CallCenter\Entities\Scripts\Repositories\Interfaces\CallCenterScriptRepositoryInterface;
use Modules\Companies\Entities\Departments\Repositories\Interfaces\DepartmentRepositoryInterface;
use Modules\Courses\Entities\Campaigns\Imports\CampaignImport;

class CallCenterCampaignService implements CallCenterCampaignServiceInterface
{
    protected $campaignInterface, $toolsInterface, $questionnaireInterface;

    public function __construct(
        CallCenterCampaignRepositoryInterface $campaignRepositoryInterface,
        CallCenterScriptRepositoryInterface $callCenterScriptRepositoryInterface,
        DepartmentRepositoryInterface $departmentRepositoryInterface,
        CallCenterQuestionnaireRepositoryInterface $callCenterQuestionnaireRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->scriptInterface          = $callCenterScriptRepositoryInterface;
        $this->campaignInterface        = $campaignRepositoryInterface;
        $this->departmentInterface      = $departmentRepositoryInterface;
        $this->questionnaireInterface   = $callCenterQuestionnaireRepositoryInterface;
        $this->toolsInterface           = $toolRepositoryInterface;
    }

    public function listCampaigns(array $data): array
    {
        $skip        = array_key_exists('skip', $data['search']) ? $data['search']['skip'] : 0;
        $fromOrigin  = array_key_exists('from', $data['search']) ? $data['search']['from'] . " 00:00:01" : '';
        $toOrigin    = array_key_exists('to', $data['search']) ? $data['search']['to'] . " 23:59:59" : '';
        $q           = array_key_exists('q', $data['search']) ? $data['search']['q'] : '';
        $search      = false;

        if ($q != '' && ($fromOrigin == '' || $toOrigin == '')) {
            $list     = $this->campaignInterface->searchCallCenterCampaign($q, $skip * 30);
            $paginate = $this->campaignInterface->countCallCenterCampaigns($q, '');
            $search = true;
        } elseif (($q != '' || $fromOrigin != '' || $toOrigin != '')) {
            $from     = $fromOrigin != '' ? $fromOrigin : Carbon::now()->subMonths(1);
            $to       = $toOrigin != '' ? $toOrigin : Carbon::now();
            $list     = $this->campaignInterface->searchCallCenterCampaign($q, $skip * 30, $from, $to);
            $paginate = $this->campaignInterface->countCallCenterCampaigns($q, $from, $to);
            $search = true;
        } else {
            $list     = $this->campaignInterface->listCallCenterCampaigns($skip * 30);
            $paginate = $this->campaignInterface->countCallCenterCampaigns('');
        }

        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $skip);

        return [
            'data' => [
                'list'               => $list,
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
                    ['label' => 'Servicios', 'type' => 'select', 'options' => $this->scriptInterface->getAllCallCenterScript(), 'name' => 'script_id', 'option' => 'name'],
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

    public function saveCampaign(array $data): bool
    {
        if (isset($data['src']) && ($data['src'] instanceof UploadedFile)) {
            Excel::import(new CampaignImport, $data['src']);
        }
        dd($data['src']);

        $this->campaignInterface->createCallCenterCampaign($data);
        return true;
    }

    public function getDataCreate(): array
    {
        return [
            'scripts'        => $this->scriptInterface->getAllCallCenterScript(),
            'departments'    => $this->departmentInterface->geDepartmentNamesForCompany(['id', 'name']),
            'questionnaires' => $this->questionnaireInterface->getAllCallCenterQuestionnaires()
        ];
    }

    public function saveFileCampaign($data)
    {
        return $this->campaignInterface->saveDocumentFile($data);
    }

    public function downloadFileCampaign($id)
    {
        $file = $this->campaignInterface->findCallCenterCampaignById($id);
        $exten = explode(".", $file->src);
        return [
            'file' => "storage/" . $file->src,
            'name' => $file->campaign . '.' . $exten[1]
        ];
    }

    public function updateCampaign(array $data): bool
    {
        $campaign  = $this->campaignInterface->findCallCenterCampaignById($data['id']);
        $repo             = new CallCenterCampaignRepository($campaign);
        $repo->updateCallCenterCampaign($data['data']);
        return true;
    }

    public function deleteCampaign(int $id): bool
    {
        $campaign     = $this->campaignInterface->findCallCenterCampaignById($id);
        $campaignRepo = new CallCenterCampaignRepository($campaign);
        $campaignRepo->deleteCallCenterCampaign();
        return true;
    }
}
