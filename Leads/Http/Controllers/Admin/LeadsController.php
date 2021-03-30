<?php

namespace Modules\Leads\Http\Controllers\Admin;

use Modules\Leads\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Companies\Entities\Departments\Repositories\Interfaces\DepartmentRepositoryInterface;
use Modules\Companies\Entities\Employees\Repositories\Interfaces\EmployeeRepositoryInterface;
use Modules\Companies\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use Modules\Leads\Entities\LeadInformations\Repositories\Interfaces\LeadInformationRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Modules\Generals\Entities\ManagementStatuses\Repositories\Interfaces\ManagementStatusRepositoryInterface;
use Modules\Leads\Entities\LeadChannels\Repositories\Interfaces\LeadChannelRepositoryInterface;
use Modules\Leads\Entities\LeadComments\Repositories\Interfaces\LeadCommentRepositoryInterface;
use Modules\Leads\Entities\LeadProducts\Repositories\Interfaces\LeadProductRepositoryInterface;
use Modules\Leads\Entities\Leads\Exports\ExportToExcel;
use Modules\Leads\Entities\LeadServices\Repositories\Interfaces\LeadServiceRepositoryInterface;
use Modules\Leads\Entities\LeadStatuses\Repositories\Interfaces\LeadStatusRepositoryInterface;

class LeadsController extends Controller
{
    private $leadInterface, $leadInformationInterface, $departmentInterface, $managementStatusInterface, $leadStatusInterface, $leadProductInterface, $leadServiceInterface, $leadCommentInterface;

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
        LeadCommentRepositoryInterface $leadCommentRepositoryInterface,
        ManagementStatusRepositoryInterface $managementStatusRepositoryInterface,
        EmployeeRepositoryInterface $employeeRepositoryInterface,
        SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface
    ) {
        $this->toolsInterface            = $toolRepositoryInterface;
        $this->leadInterface             = $LeadRepositoryInterface;
        $this->cityInterface             = $cityRepositoryInterface;
        $this->leadStatusInterface       = $leadStatusRepositoryInterface;
        $this->departmentInterface       = $departmentRepositoryInterface;
        $this->leadProductInterface      = $leadProductRepositoryInterface;
        $this->leadServiceInterface      = $leadServiceRepositoryInterface;
        $this->leadChannelInterface      = $leadChannelRepositoryInterface;
        $this->leadCommentInterface      = $leadCommentRepositoryInterface;
        $this->leadInformationInterface  = $LeadInformationRepositoryInterface;
        $this->managementStatusInterface = $managementStatusRepositoryInterface;
        $this->subsidiaryInterface       = $subsidiaryRepositoryInterface;
        $this->employeeInterface       = $employeeRepositoryInterface;
        $this->middleware(['permission:leads, guard:employee']);
    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        foreach (auth()->guard('employee')->user()->department as $key => $deparmentUser) {
            $userDepartmet[$key] = $deparmentUser->id;
        }

        if (request()->has('action')) {
            if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
                $list = $this->leadInterface->exportLeads(request()->input('q'));
                $request->session()->flash('message', 'Se ha exportado su busqueda');
            } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
                $list = $this->leadInterface->exportLeads(request()->input('q'), $from, $to);
                $request->session()->flash('message', 'Se ha exportado su busqueda');
            } else {
                $list = $this->leadInterface->exportLeads('');
            }

            $cont = 0;
            ini_set('memory_limit', "700M");
            foreach ($list as $key => $value) {
                $cont++;
                if ($cont == 1) {
                    $printExcel[] = [
                        'Cedula',
                        'Nombrbes',
                        'Apellidos',
                        'Correo',
                        'Telefono',
                        'Ciudad',
                        'Estado',
                        'Area encargada',
                        // 'Empleado asignado',
                        'Servicio',
                        'Producto',
                        'Canal de adquisicion ',
                        'Estado de gestion',
                        'Tipo de cliente',
                        'Entidad',
                        'Monto',
                        'Plazo',
                        'Fecha'
                    ];
                }
                $printExcel[] = [
                    $value->identification_number,
                    $value->name,
                    $value->last_name,
                    $value->email,
                    $value->telephone,
                    $value->city != null ? $value->city->city : 'NA',
                    $value->leadStatuses ? $value->leadStatuses->status : "SIN ESTADO",
                    $value->department != null  ? $value->department->name : 'NA',
                    $value->leadService != null ? $value->leadService->service : 'NA',
                    $value->leadProduct != null ? $value->leadProduct->product : 'NA',
                    $value->leadChannel != null ? $value->leadChannel->channel : 'NA',
                    $value->managementStatusLead != null ? $value->managementStatusLead->status : 'NA',
                    $value->department != null ? ($value->leadInformation ? $value->leadInformation->kind_of_person : 'NA') : 'NA',
                    $value->department != null ? ($value->leadInformation ? $value->leadInformation->entity : 'NA') : 'NA',
                    $value->department != null ? ($value->leadInformation ? $value->leadInformation->amount : 'NA') : 'NA',
                    $value->department != null ? ($value->leadInformation ? $value->leadInformation->term : 'NA') : 'NA',
                    $value->created_at
                ];
            }

            $export = new ExportToExcel($printExcel);
            return Excel::download($export, 'leads.xlsx');
        }

        $employee = null;

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->leadInterface->searchLeads($employee, request()->input('q'), $skip * 30);
            $paginate = $this->leadInterface->countLeads($employee, request()->input('q'), '');
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->leadInterface->searchLeads(request()->input('q'), $skip * 30, $from, $to);
            $paginate = $this->leadInterface->countLeads($employee, request()->input('q'), $from, $to);
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else {
            $list     = $this->leadInterface->listLeads($employee, $skip * 30, $userDepartmet);
            $paginate = $this->leadInterface->countLeads($employee, '');
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

        return view('leads::admin.leads.list', [
            'leads'         => $list,
            'optionsRoutes' => 'admin.' . (request()->segment(2)),
            'skip'          => $skip,
            'paginate'      => $getPaginate['paginate'],
            'position'      => $getPaginate['position'],
            'page'          => $getPaginate['page'],
            'limit'         => $getPaginate['limit'],
            'headers'       => ['', 'Cédula', 'Nombres', 'apellidos', 'Teléfono', 'Area', 'Fecha', 'estado', 'Opciones'],
            'inputsAssigne' => [
                ['label' => 'Area', 'type' => 'select', 'options' => $this->departmentInterface->geDepartmentNamesForCompany(['id', 'name']), 'name' => 'department_id', 'option' => 'name'],
                ['label' => 'Servicios', 'type' => 'select', 'options' => [], 'name' => 'lead_service_id', 'option' => 'service', 'disabled' => 'true'],
                ['label' => 'Productos', 'type' => 'select', 'options' => [], 'name' => 'lead_product_id', 'option' => 'product', 'disabled' => 'true'],
                ['label' => 'Estado de gestión', 'type' => 'select', 'options' => $this->managementStatusInterface->getStatusesForType(0, ['id', 'status']), 'name' => 'management_status_id', 'option' => 'status'],
                ['label' => 'Sucursal', 'type' => 'select', 'options' => $this->subsidiaryInterface->findSubsidiaryForCompany(auth()->guard('employee')->user()->company_id), 'name' => 'subsidiary_id', 'option' => 'name'],
                ['label' => 'Estado', 'type' => 'select', 'options' => $this->leadStatusInterface->getAllLeadStatusesNames(['id', 'status']), 'name' => 'lead_status_id', 'option' => 'status']
            ],
            'inputs' => [
                ['label' => 'Nombres', 'type' => 'text', 'name' => 'name'],
                ['label' => 'Apellidos', 'type' => 'text', 'name' => 'last_name'],
                ['label' => 'Correo', 'type' => 'text', 'name' => 'email'],
                ['label' => 'Teléfono', 'type' => 'text', 'name' => 'telephone'],
                ['label' => 'Ciudad', 'type' => 'select', 'options' => $this->cityInterface->listCitiesForLeads(['id', 'city']), 'name' => 'city_id', 'option' => 'city'],
                ['label' => 'Estado de gestión', 'type' => 'select', 'options' => $this->managementStatusInterface->getStatusesForType(0, ['id', 'status']), 'name' => 'management_status_id', 'option' => 'status'],
                ['label' => 'Estado', 'type' => 'select', 'options' => $this->leadStatusInterface->getAllLeadStatusesNames(['id', 'status']), 'name' => 'lead_status_id', 'option' => 'status'],
                ['label' => 'Canal', 'type' => 'select', 'options' => $this->leadChannelInterface->getAllLeadChannelsNames(), 'name' => 'lead_channel_id', 'option' => 'channel']
            ], 'routeEdit' => 'admin.leads.update'
        ]);
    }

    public function listAssesor(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        foreach (auth()->guard('employee')->user()->department as $key => $deparmentUser) {
            $userDepartmet[$key] = $deparmentUser->id;
        }

        $employee = auth()->guard('employee')->user();

        if (request()->input('q'    ) != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->leadInterface->searchLeads($employee, request()->input('q'), $skip * 30);
            $paginate = $this->leadInterface->countLeads($employee, request()->input('q'), '');
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->leadInterface->searchLeads(request()->input('q'), $skip * 30, $from, $to);
            $paginate = $this->leadInterface->countLeads($employee, request()->input('q'), $from, $to);
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else {
            $list     = $this->leadInterface->listLeads($employee, $skip * 30, $userDepartmet);
            $paginate = $this->leadInterface->countLeads($employee, '');
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

        return view('leads::admin.leads.list', [
            'leads'         => $list,
            'optionsRoutes' => 'admin.' . (request()->segment(2)),
            'skip'          => $skip,
            'routeHome'     => 'admin.leads.assesors',
            'paginate'      => $getPaginate['paginate'],
            'position'      => $getPaginate['position'],
            'page'          => $getPaginate['page'],
            'limit'         => $getPaginate['limit'],
            'headers'       => ['', 'Cédula', 'Nombres', 'apellidos', 'Teléfono', 'Area', 'Fecha', 'estado', 'Opciones'],
            'inputsAssigne' => [
                ['label' => 'Area', 'type' => 'select', 'options' => $this->departmentInterface->geDepartmentNamesForCompany(['id', 'name']), 'name' => 'department_id', 'option' => 'name'],
                ['label' => 'Servicios', 'type' => 'select', 'options' => [], 'name' => 'lead_service_id', 'option' => 'service', 'disabled' => 'true'],
                ['label' => 'Productos', 'type' => 'select', 'options' => [], 'name' => 'lead_product_id', 'option' => 'product', 'disabled' => 'true'],
                ['label' => 'Estado de gestión', 'type' => 'select', 'options' => $this->managementStatusInterface->getStatusesForType(0, ['id', 'status']), 'name' => 'management_status_id', 'option' => 'status'],
                ['label' => 'Sucursal', 'type' => 'select', 'options' => $this->subsidiaryInterface->findSubsidiaryForCompany(auth()->guard('employee')->user()->company_id), 'name' => 'subsidiary_id', 'option' => 'name'],
                ['label' => 'Estado', 'type' => 'select', 'options' => $this->leadStatusInterface->getAllLeadStatusesNames(['id', 'status']), 'name' => 'lead_status_id', 'option' => 'status']
            ],
            'inputs' => [
                ['label' => 'Nombres', 'type' => 'text', 'name' => 'name'],
                ['label' => 'Apellidos', 'type' => 'text', 'name' => 'last_name'],
                ['label' => 'Correo', 'type' => 'text', 'name' => 'email'],
                ['label' => 'Teléfono', 'type' => 'text', 'name' => 'telephone'],
                ['label' => 'Ciudad', 'type' => 'select', 'options' => $this->cityInterface->listCitiesForLeads(['id', 'city']), 'name' => 'city_id', 'option' => 'city'],
                ['label' => 'Estado de gestión', 'type' => 'select', 'options' => $this->managementStatusInterface->getStatusesForType(0, ['id', 'status']), 'name' => 'management_status_id', 'option' => 'status'],
                ['label' => 'Estado', 'type' => 'select', 'options' => $this->leadStatusInterface->getAllLeadStatusesNames(['id', 'status']), 'name' => 'lead_status_id', 'option' => 'status'],
                ['label' => 'Canal', 'type' => 'select', 'options' => $this->leadChannelInterface->getAllLeadChannelsNames(), 'name' => 'lead_channel_id', 'option' => 'channel'],
                ['label' => 'Tipo de cliente', 'type' => 'select', 'options' => $this->leadChannelInterface->getAllLeadChannelsNames(), 'name' => 'kind_of_person', 'option' => 'channel', 'join' => 'leadInformation']
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
        $lead->leadStatus()->attach($request->input('lead_status_id'), ['employee_id' => auth()->guard('employee')->user()->id]);
        $this->leadInformationInterface->createLeadInformation($request->only('lead_id',  'kind_of_person', 'amount', 'term', 'entity'));

        return redirect()->route('thank.you.page');
    }

    public function show($id)
    {
        $status = $this->leadStatusInterface->getAllLeadStatusesNames(['id', 'status']);
        $lead   = $this->leadInterface->findLeadByIdFull($id);

        return view('leads::admin.leads.show', [
            'lead' => $lead,
            'inputsAssigne' => [
                ['label' => 'Area', 'type' => 'select', 'options' => $this->departmentInterface->geDepartmentNamesForCompany(['id', 'name']), 'name' => 'department_id', 'option' => 'name'],
                ['label' => 'Servicios', 'type' => 'select', 'options' => $this->leadServiceInterface->getAllLeadServiceNames(), 'name' => 'lead_service_id', 'option' => 'service', 'disabled' => 'true'],
                ['label' => 'Productos', 'type' => 'select', 'options' => $this->leadProductInterface->getAllLeadProductNames(), 'name' => 'lead_product_id', 'option' => 'product', 'disabled' => 'true'],
                ['label' => 'Estado de gestión', 'type' => 'select', 'options' => $this->managementStatusInterface->getStatusesForType(0, ['id', 'status']), 'name' => 'management_status_id', 'option' => 'status'],
                ['label' => 'Estado', 'type' => 'select', 'options' => $status, 'name' => 'lead_status_id', 'option' => 'status']
            ],
            'inputs' => [
                ['label' => 'Nombres', 'type' => 'text', 'name' => 'name'],
                ['label' => 'Apellidos', 'type' => 'text', 'name' => 'last_name'],
                ['label' => 'Correo', 'type' => 'text', 'name' => 'email'],
                ['label' => 'Teléfono', 'type' => 'text', 'name' => 'telephone'],
                ['label' => 'Ciudad', 'type' => 'select', 'options' => $this->cityInterface->listCitiesForLeads(['id', 'city']), 'name' => 'city_id', 'option' => 'city'],
                ['label' => 'Estado de gestión', 'type' => 'select', 'options' => $this->managementStatusInterface->getStatusesForType(0, ['id', 'status']), 'name' => 'management_status_id', 'option' => 'status'],
                ['label' => 'Estado', 'type' => 'select', 'options' => $status, 'name' => 'lead_status_id', 'option' => 'status'],
                ['label' => 'Canal', 'type' => 'select', 'options' => $this->leadChannelInterface->getAllLeadChannelsNames(), 'name' => 'lead_channel_id', 'option' => 'channel']
            ], 'routeEdit' => 'admin.leads.update'
        ]);
    }

    public function edit($id)
    {
        return view('leads::edit');
    }

    public function update(Request $request, $id)
    {
        $validate = $this->leadInterface->findLeadByIdFull($id);

        $lead = $this->leadInterface->updateLead($id, $request->except('_token', 'emailConfirm', 'kind_of_person', 'amount', 'term', 'entity', '_method'));

        if (!empty($request->input('lead_status_id')) && $request->input('lead_status_id') != $validate->lead_status_id) {
            $lead->leadStatus()->attach($request->input('lead_status_id'), ['employee_id' => auth()->guard('employee')->user()->id]);
        }

        if (!empty($request->input('management_status_id')) && $request->input('management_status_id') != $validate->management_status_id) {
            $lead->managementStatus()->attach($request->input('management_status_id'), ['employee_id' => auth()->guard('employee')->user()->id]);
        }

        $this->leadInformationInterface->updateLeadInformation($id, $request->only('kind_of_person', 'amount', 'term', 'entity', 'expiration_date_soat', 'subsidiary_id'));

        $request->session()->flash('message', 'Lead actualizado correctamente');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $lead = $this->leadInterface->findLeadByIdFull($id);
        $lead->delete();

        request()->session()->flash('message', 'Lead eliminado correctamente');
        return redirect()->back();
    }

    public function comments(Request $request)
    {
        $data = $request->except('_token');
        $data['employee_id'] = auth()->guard('employee')->user()->id;
        $data['comment'] = $data['commentary'];
        $request->session()->flash('message', 'Comentario creado correctamente');
        $this->leadCommentInterface->createLeadComment($data);

        return redirect()->route('admin.leads.show', $data['lead_id']);
    }

    public function searchDepartment($id)
    {
        return $this->departmentInterface->findDepartmentById($id);
    }

    public function searchAsessors($id)
    {
        return  $this->employeeInterface->findEmployeeBySubsidiary($id);
    }
}
