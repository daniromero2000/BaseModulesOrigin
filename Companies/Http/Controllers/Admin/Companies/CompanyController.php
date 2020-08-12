<?php

namespace Modules\Companies\Http\Controllers\Admin\Companies;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Companies\Entities\Companies\Repositories\Interfaces\CompanyRepositoryInterface;

class CompanyController extends Controller
{
    private $toolsInterface;
    private $companyInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        CompanyRepositoryInterface $companyRepositoryInterface
    ) {
        $this->toolsInterface = $toolRepositoryInterface;
        $this->middleware(['permission:customers, guard:employee']);
        $this->companyInterface = $companyRepositoryInterface;
    }

    public function index(Request $request)
    {
        //return view('companies::Admin.companies.index');
        $list = $this->companyInterface->listCompanies();
        //dd($list);

        return view('companies::admin.companies.list', [
            'companies' => $list,
            //'optionsRoutes' => 'admin.'.(request()->segment(2)),
            //'skip' => $skip,
            'headers' => ['Nombre', 'Ciudad', 'Identificación', 'Tipo', 'Estado', 'Opciones'],
            /*'roles'              => $this->roleInterface->getAllRoleNames(),
            'all_departments'    => $this->departmentInterface->getAllDepartmentNames()*/
        ]);
    }

    /*public function create()
    {
        return view('customers::admin.customers.create', [
            'genres' => $this->genreInterface->getAllGenresNames(),
            'customer_channels' => $this->customerChannelInterface->getAllCustomerChannelNames(),
            'scholarities' => $this->scholarityInterface->getAllScholaritiesNames(),
            'civil_statuses' => $this->civilStatusInterface->getAllCivilStatusesNames(),
            'cities' => $this->cityInterface->listCities(),
        ]);
    }

    public function store(CreateCustomerRequest $request)
    {
        $customer = $this->customerInterface->createCustomer($request->except('_token', '_method'));

        $data = array(
            'customer_id' => $customer->id,
            'status' => 'Creado',
            'employee_id' => auth()->guard('employee')->user()->id,
        );

        $this->customerStatusesLogInterface->createCustomerStatusesLog($data);

        $request->session()->flash('message', config('messaging.create'));

        return redirect()->route('admin.customers.show', $customer->id);
    }

    public function show(int $id)
    {
        return view('customers::admin.customers.show', [
            'customer' => $this->customerInterface->findCustomerById($id),
        ]);
    }

    public function edit($id)
    {
        $customer = $this->customerInterface->findCustomerById($id);

        return view('customers::admin.customers.edit', [
            'customer' => $customer,
            'customer_channels' => $this->customerChannelInterface->getAllCustomerChannelNames(),
            'statuses' => $this->customerStatusInterface->listCustomerStatuses(),
            'scholarities' => $this->scholarityInterface->getAllScholaritiesNames(),
            'cities' => $this->cityInterface->listCities(),
            'currentStatus' => $customer->customerStatus->id,
            'lead' => $customer->customerChannel->id,
            'customer_scholarity' => $customer->scholarity->id,
            'customer_city' => $customer->city->id,
        ]);
    }

    public function update(UpdateCustomerRequest $request, $id)
    {
        $customer = $this->customerInterface->findCustomerById($id);
        $update = new CustomerRepository($customer);
        $data = $request->except('customer_channel', 'customer_status', '_method', '_token', 'password');
        if ($request->has('password')) {
            $data['password'] = bcrypt($request->input('password'));
        }

        unset($customer->age);
        $update->updateCustomer($data);

        $customer = $this->customerInterface->findCustomerById($id);

        $customerStatusLog = array(
            'customer_id' => $customer->id,
            'status' => $customer->customerStatus->status,
            'employee_id' => auth()->guard('employee')->user()->id,
        );

        $customerStatusLogs = $this->customerStatusesLogInterface->createCustomerStatusesLog($customerStatusLog);

        return response()->json([$update, $customerStatusLogs], 201);
    }

    public function destroy($id)
    {
        $customerRepo = new CustomerRepository($this->customerInterface->findCustomerById($id));
        $customerRepo->deleteCustomer();

        return redirect()->route('admin.customers.index')
            ->with('message', 'Eliminado Satisfactoriamente');
    }

    public function getCustomer(int $id)
    {
        $customer = $this->customerInterface->findCustomerById($id);

        return [
            'customer' => $customer,
            'currentStatus' => $customer->customerStatus,
        ];
    }

    public function list(Request $request)
    {
        if (request()->has('q')) {
            $list = $this->customerInterface->searchCustomer(request()->input('q'));
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } elseif (request()->has('t')) {
            $list = $this->customerInterface->searchTrashedCustomer(request()->input('t'));
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else {
            $skip = $this->toolsInterface->getSkip($request->input('skip'));
            $list = $this->customerInterface->listCustomers($skip * 30);
        }

        return [
            'customers' => $list,
            'headers' => ['Nombre', 'Apellido', 'Fecha Ingreso', 'Lead', 'Estado', 'Opciones'],
            'optionsRoutes' => 'admin.'.(request()->segment(2)),
        ];
    }

    public function getlistEconomicActivity(Request $request)
    {
        return [
            'professions_lists' => $this->professionsListInterface->getAllProfessionsNames(),
            'economic_activity_types' => $this->economicActivityInterface->getAllEconomicActivityTypesNames(),
        ];
    }

    public function getListCities(Request $request)
    {
        return [
            'cities' => $this->cityInterface->listCities(),
        ];
    }

    public function getRelationships(Request $request)
    {
        return [
            'relationships' => $this->relationshipInterface->getAllRelationshipsNames(),
        ];
    }

    public function getCivilStatuses(Request $request)
    {
        return [
            'civil_statuses' => $this->civilStatusInterface->getAllCivilStatusesNames(),
        ];
    }

    public function getGenres(Request $request)
    {
        return [
            'genres' => $this->genreInterface->getAllGenresNames(),
        ];
    }

    public function getScholarities(Request $request)
    {
        return [
            'scholarities' => $this->scholarityInterface->getAllScholaritiesNames(),
        ];
    }

    public function getProfessions(Request $request)
    {
        return [
            'professions' => $this->professionsListInterface->getAllProfessionsNames(),
        ];
    }

    public function getVehicles(Request $request)
    {
        return [
            'vehicle_types' => $this->vehicleTypeInterface->getAllVehicleTypesNames(),
            'vehicle_brands' => $this->vehicleBrandInterface->getAllVehicleBrandsNames(),
        ];
    }

    public function getIdentityTypes(Request $request)
    {
        return [
            'identity_types' => $this->identityTypeInterface->getAllIdentityTypesNames(),
        ];
    }

    public function getHousings(Request $request)
    {
        return [
            'housings' => $this->housingInterface->getAllHousingsNames(),
        ];
    }

    public function getStratums(Request $request)
    {
        return [
            'stratums' => $this->stratumInterface->getAllStratumsNames(),
        ];
    }

    public function getEps(Request $request)
    {
        return [
            'epss' => $this->epsInterface->getAllEpsNames(),
        ];
    }*/
}
