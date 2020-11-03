<?php

namespace Modules\Leads\Http\Controllers\Admin;

use Modules\Leads\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Companies\Entities\Departments\Repositories\Interfaces\DepartmentRepositoryInterface;
use Modules\Leads\Entities\LeadInformations\Repositories\Interfaces\LeadInformationRepositoryInterface;
use Modules\Leads\Entities\Leads\Requests\CreateLeadRequest;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Modules\Generals\Entities\ManagementStatuses\Repositories\Interfaces\ManagementStatusRepositoryInterface;
use Modules\Leads\Entities\LeadChannels\Repositories\Interfaces\LeadChannelRepositoryInterface;
use Modules\Leads\Entities\LeadProducts\Repositories\Interfaces\LeadProductRepositoryInterface;
use Modules\Leads\Entities\LeadServices\Repositories\Interfaces\LeadServiceRepositoryInterface;
use Modules\Leads\Entities\LeadStatuses\Repositories\Interfaces\LeadStatusRepositoryInterface;

class LeadsController extends Controller
{
    private $leadInterface, $leadInformationInterface, $departmentInterface, $managementStatusInterface, $leadStatusInterface, $leadProductInterface, $leadServiceInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        LeadRepositoryInterface $LeadRepositoryInterface,
        CityRepositoryInterface $cityRepositoryInterface,
        LeadStatusRepositoryInterface $leadStatusRepositoryInterface,
        DepartmentRepositoryInterface $departmentRepositoryInterface,
        LeadServiceRepositoryInterface $leadServiceRepositoryInterface,
        LeadProductRepositoryInterface $leadProductRepositoryInterface,
        LeadChannelRepositoryInterface $leadChannelRepositoryInterface,
        LeadInformationRepositoryInterface $LeadInformationRepositoryInterface,
        ManagementStatusRepositoryInterface $managementStatusRepositoryInterface
    ) {
        $this->toolsInterface            = $toolRepositoryInterface;
        $this->leadInterface             = $LeadRepositoryInterface;
        $this->cityInterface             = $cityRepositoryInterface;
        $this->leadStatusInterface       = $leadStatusRepositoryInterface;
        $this->departmentInterface       = $departmentRepositoryInterface;
        $this->leadProductInterface      = $leadProductRepositoryInterface;
        $this->leadServiceInterface      = $leadServiceRepositoryInterface;
        $this->leadInformationInterface  = $LeadInformationRepositoryInterface;
        $this->leadChannelInterface      = $leadChannelRepositoryInterface;
        $this->managementStatusInterface = $managementStatusRepositoryInterface;
        $this->middleware(['permission:leads, guard:employee']);
    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        foreach (auth()->guard('employee')->user()->department as $key => $value) {
            $userDepartmet[$key] = $value->id;
        }

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list = $this->leadInterface->searchLeads(request()->input('q'), $skip);
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list = $this->leadInterface->searchLeads(request()->input('q'), $skip, $from, $to);
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else {
            $list = $this->leadInterface->listLeads($skip * 30, $userDepartmet);
        }

        // if (request()->has('q')) {
        //     $list = $this->leadInterface->searchLeads(request()->input('q'), $userDepartmet);
        //     $request->session()->flash('message', 'Resultado de la Busqueda');
        // } elseif (request()->has('t')) {
        //     $list = $this->leadInterface->searchTrashedLead(request()->input('t'));
        //     $request->session()->flash('message', 'Resultado de la Busqueda');
        // } else {
        //     $skip = $this->toolsInterface->getSkip($request->input('skip'));
        //     $list = $this->leadInterface->listLeads($skip * 30, $userDepartmet);
        // }

        return view('leads::admin.leads.list', [
            'leads' => $list,
            'optionsRoutes' => 'admin.' . (request()->segment(2)),
            'skip' => $skip,
            'headers' => ['Id', 'Nombres', 'apellidos', 'Correo', 'Teléfono', 'Area', 'Fecha', 'estado', 'Opciones'],
            'inputs'     => [
                ['label' => 'Nombres', 'type' => 'text', 'name' => 'name'],
                ['label' => 'Apellidos', 'type' => 'text', 'name' => 'last_name'],
                ['label' => 'Correo', 'type' => 'text', 'name' => 'email'],
                ['label' => 'Teléfono', 'type' => 'text', 'name' => 'telephone'],
                ['label' => 'Ciudad', 'type' => 'select', 'options' => $this->cityInterface->listCities(), 'name' => 'city_id', 'option' => 'city'],
                ['label' => 'Area', 'type' => 'select', 'options' => $this->departmentInterface->getAllDepartmentNames(), 'name' => 'department_id', 'option' => 'name'],
                ['label' => 'Estado de gestión', 'type' => 'select', 'options' => $this->managementStatusInterface->getStatusesForType(0), 'name' => 'management_status_id', 'option' => 'status']
            ], 'routeEdit' => 'admin.leads.update'
        ]);
    }

    public function create()
    {
        return view('leads::create');
    }

    public function store(Request $request)
    {
        $lead = $this->leadInterface->createLead($request->except('_token', 'emailConfirm', 'kind_of_person', 'amount', 'term', 'entity'));

        $request->merge(['lead_id' => $lead->id]);

        $this->leadInformationInterface->createLeadInformation($request->only('lead_id',  'kind_of_person', 'amount', 'term', 'entity'));

        return redirect()->route('thank.you.page');
    }

    public function show($id)
    {
        $lead = $this->leadInterface->findLeadByIdFull($id);

        return view('leads::admin.leads.show', [
            'lead' => $lead,
            'inputs'     => [
                ['label' => 'Nombres', 'type' => 'text', 'name' => 'name'],
                ['label' => 'Apellidos', 'type' => 'text', 'name' => 'last_name'],
                ['label' => 'Correo', 'type' => 'text', 'name' => 'email'],
                ['label' => 'Teléfono', 'type' => 'text', 'name' => 'telephone'],
                ['label' => 'Ciudad', 'type' => 'select', 'options' => $this->cityInterface->listCities(), 'name' => 'city_id', 'option' => 'city'],
                ['label' => 'Area', 'type' => 'select', 'options' => $this->departmentInterface->getAllDepartmentNames(), 'name' => 'department_id', 'option' => 'name'],
                ['label' => 'Estado de gestión', 'type' => 'select', 'options' => $this->managementStatusInterface->getStatusesForType(0), 'name' => 'management_status_id', 'option' => 'status']
            ], 'routeEdit' => 'admin.leads.update'
        ]);
    }

    public function edit($id)
    {
        return view('leads::edit');
    }

    public function update(Request $request, $id)
    {
        $lead = $this->leadInterface->updateLead($id, $request->except('_token', 'emailConfirm', 'kind_of_person', 'amount', 'term', 'entity'));
        dd($lead);
        $request->merge(['lead_id' => $lead->id]);

        // $this->leadInformationInterface->updateLead($id, $request->only('lead_id',  'kind_of_person', 'amount', 'term', 'entity'));

        return redirect()->route('thank.you.page');
    }

    public function destroy($id)
    {
        //
    }
}
