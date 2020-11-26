<?php

namespace Modules\Companies\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\Companies\Entities\Employees\Requests\CreateEmployeeRequest;
use Modules\Companies\Entities\Employees\Requests\UpdateEmployeeRequest;
use Modules\Companies\Entities\Companies\Repositories\Interfaces\CompanyRepositoryInterface;
use Modules\Companies\Entities\Departments\Repositories\Interfaces\DepartmentRepositoryInterface;
use Modules\Companies\Entities\EmployeeCommentaries\Repositories\Interfaces\EmployeeCommentaryRepositoryInterface;
use Modules\Companies\Entities\EmployeePositions\Repositories\Interfaces\EmployeePositionRepositoryInterface;
use Modules\Companies\Entities\Employees\Exceptions\EmployeeNotFoundException;
use Modules\Companies\Entities\Employees\Repositories\EmployeeRepository;
use Modules\Companies\Entities\Employees\Repositories\Interfaces\EmployeeRepositoryInterface;
use Modules\Companies\Entities\EmployeeStatusesLogs\Repositories\Interfaces\EmployeeStatusesLogRepositoryInterface;
use Modules\Companies\Entities\Roles\Repositories\Interfaces\RoleRepositoryInterface;
use Modules\Companies\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Modules\Generals\Entities\Epss\Repositories\Interfaces\EpsRepositoryInterface;
use Modules\Generals\Entities\Housings\Repositories\Interfaces\HousingRepositoryInterface;
use Modules\Generals\Entities\IdentityTypes\Repositories\Interfaces\IdentityTypeRepositoryInterface;
use Modules\Generals\Entities\ProfessionsLists\Repositories\Interfaces\ProfessionsListRepositoryInterface;
use Modules\Generals\Entities\Stratums\Repositories\Interfaces\StratumRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class EmployeeController extends Controller
{
    private $employeeInterface, $roleInterface, $departmentInterface;
    private $employeePositionInterface, $employeeCommentaryInterface;
    private $employeeStatusesLogInterface, $cityInterface, $identityTypeInterface;
    private $stratumInterface, $housingInterface, $epsInterface;
    private $professionsListInterface, $toolsInterface, $subsidiaryInterface;

    public function __construct(
        EmployeeRepositoryInterface $employeeRepositoryInterface,
        RoleRepositoryInterface $roleRepositoryInterface,
        DepartmentRepositoryInterface $departmentRepositoryInterface,
        EmployeePositionRepositoryInterface $employeePositionRepositoryInterface,
        EmployeeCommentaryRepositoryInterface $employeeCommentaryRepositoryInterface,
        EmployeeStatusesLogRepositoryInterface $employeeStatusesLogRepositoryInterface,
        CityRepositoryInterface $cityRepositoryInterface,
        IdentityTypeRepositoryInterface $identityTypeRepositoryInterface,
        StratumRepositoryInterface $stratumRepositoryInterface,
        HousingRepositoryInterface $housingRepositoryInterface,
        EpsRepositoryInterface $epsRepositoryInterface,
        ProfessionsListRepositoryInterface $professionsListRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        CustomerRepositoryInterface $customerRepositoryInterface,
        SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface,
        CompanyRepositoryInterface $companyRepositoryInterface
    ) {
        $this->toolsInterface               = $toolRepositoryInterface;
        $this->employeeInterface            = $employeeRepositoryInterface;
        $this->roleInterface                = $roleRepositoryInterface;
        $this->departmentInterface          = $departmentRepositoryInterface;
        $this->employeePositionInterface    = $employeePositionRepositoryInterface;
        $this->employeeCommentaryInterface  = $employeeCommentaryRepositoryInterface;
        $this->employeeStatusesLogInterface = $employeeStatusesLogRepositoryInterface;
        $this->cityInterface                = $cityRepositoryInterface;
        $this->identityTypeInterface        = $identityTypeRepositoryInterface;
        $this->stratumInterface             = $stratumRepositoryInterface;
        $this->housingInterface             = $housingRepositoryInterface;
        $this->epsInterface                 = $epsRepositoryInterface;
        $this->professionsListInterface     = $professionsListRepositoryInterface;
        $this->customerInterface            = $customerRepositoryInterface;
        $this->subsidiaryInterface          = $subsidiaryRepositoryInterface;
        $this->companyInterface          = $companyRepositoryInterface;
        $this->middleware(['permission:employees, guard:employee']);
    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();
        $company = null;
        if (auth()->guard('employee')->user()->role[0]->id != 1) {
            $company = auth()->guard('employee')->user()->company_id;
        }

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list = $this->employeeInterface->searchEmployee(request()->input('q'), $company, $skip * 30);
            $paginate = $this->employeeInterface->countEmployees(request()->input('q'), $company, '');
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list = $this->employeeInterface->searchEmployee(request()->input('q'), $company, $skip * 30, $from, $to);
            $paginate = $this->employeeInterface->countEmployees(request()->input('q'), $company, $from, $to);
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else {
            $paginate = $this->employeeInterface->countEmployees('', $company);
            $list = $this->employeeInterface->listEmployees($skip * 30, $company);
        }

        $paginate = ceil($paginate  / 30);

        $skipPaginate = $skip;

        $pageList = ($skipPaginate + 1) / 5;
        if (is_int($pageList) || $pageList > 1) {
            $countPage = $skipPaginate - 5;
            $maxPage = $skipPaginate + 6 > $paginate ? intval($skipPaginate + ($paginate - $skipPaginate)) : $skipPaginate + 6;
        } else {
            $countPage = 0;
            $maxPage = $skipPaginate + 5 > $paginate ? intval($skipPaginate + ($paginate - $skipPaginate)) : $skipPaginate + 5;
        }

        return view('companies::admin.employees.list', [
            'employees'          => $list,
            'optionsRoutes'      => 'admin.' . (request()->segment(2)),
            'headers'            => ['Id', 'Nombre', 'Email', 'Cargo', 'Estado', 'Opciones'],
            'searchInputs'       => [['label' => 'Buscar', 'type' => 'text', 'name' => 'q'], ['label' => 'Desde', 'type' => 'date', 'name' => 'from'], ['label' => 'Hasta', 'type' => 'date', 'name' => 'to']],
            'skip'               => $skip,
            'pag'                => $pageList,
            'i'                  => $countPage,
            'max'                => $maxPage,
            'paginate'           => $paginate,
            'roles'              => $this->roleInterface->getAllRoleNames(),
            'all_departments'    => $this->departmentInterface->geDepartmentNamesForCompany(),
            'employee_positions' => $this->employeePositionInterface->getEmployeePositionNamesForCompany(),
        ]);
    }

    public function create()
    {
        return view('companies::admin.employees.create', [
            'roles'              => $this->roleInterface->getAllRoleNames(),
            'departments'        => $this->departmentInterface->geDepartmentNamesForCompany(),
            'employee_positions' => $this->employeePositionInterface->getEmployeePositionNamesForCompany(),
            'subsidiaries'       => $this->subsidiaryInterface->getSubsidiaryForCompany(auth()->guard('employee')->user()->company_id),
            'companies'          => $this->companyInterface->listCompaniesActives(),
            'all_departments'    => $this->departmentInterface->geDepartmentNamesForCompany(),
        ]);
    }

    public function store(CreateEmployeeRequest $request)
    {
        if(is_null($request->input('company_id'))){
            $request->merge(['company_id' => auth()->guard('employee')->user()->company_id]);
        }
        $employee = $this->employeeInterface->createEmployee($request->all());
        $data = [
            'employee_id' => $employee->id,
            'status'      => 'Creado',
            'user_id'     => auth()->guard('employee')->user()->id,
        ];

        $this->employeeStatusesLogInterface->createEmployeeStatusesLog($data);
        $isCurrentUser = $this->employeeInterface->isAuthUser($employee);

        if ($request->has('password') && !empty($request->input('password'))) {
            $employee->password = Hash::make($request->input('password'));
            $employee->save();
        }

        if ($request->has('roles') and !$isCurrentUser) {
            $employee->roles()->sync($request->input('roles'));
        } elseif (!$isCurrentUser) {
            $employee->roles()->detach();
        }

        if ($request->has('department_id')) {
            $employee->department()->sync($request->input('department_id'));
        }

        return redirect()->route('admin.employees.index')
            ->with('message', 'Empleado Creado Exitosamente!');
    }

    public function show(int $id)
    {
        try {
            return view('companies::admin.employees.show', [
                'employee'           => $this->employeeInterface->findEmployeeById($id),
                'cities'             => $this->cityInterface->listCities(),
                'identity_types'     => $this->identityTypeInterface->getAllIdentityTypesNames(),
                'stratums'           => $this->stratumInterface->getAllStratumsNames(),
                'housings'           => $this->housingInterface->getAllHousingsNames(),
                'epss'               => $this->epsInterface->getAllEpsNames(),
                'professions_lists'  => $this->professionsListInterface->getAllProfessionsNames(),
                'employee_positions' => $this->employeePositionInterface->getEmployeePositionNamesForCompany(),
                'all_departments'    => $this->departmentInterface->geDepartmentNamesForCompany(),
                'roles'              => $this->roleInterface->getAllRoleNames(),
            ]);
        } catch (EmployeeNotFoundException $e) {
            request()->session()->flash('error', 'El Empleado que estás buscando no se encuentra');

            return redirect()->route('admin.employees.index');
        }
    }

    public function edit(int $id)
    {
        return redirect()->route('admin.employees.index');
    }

    public function update(UpdateEmployeeRequest $request, $id)
    {
        $employee      = $this->employeeInterface->findEmployeeById($id);
        $isCurrentUser = $this->employeeInterface->isAuthUser($employee);
        $empRepo       = new EmployeeRepository($employee);
        $empRepo->updateEmployee($request->except('_token', '_method', 'password'));

        if ($request->has('password') && !empty($request->input('password'))) {
            $employee->password = Hash::make($request->input('password'));
            $employee->save();
        }

        if ($request->has('roles') and !$isCurrentUser) {
            $employee->roles()->sync($request->input('roles'));
        } elseif (!$isCurrentUser) {
            $employee->roles()->detach();
        }

        if ($request->has('department_id')) {
            $employee->department()->sync($request->input('department_id'));
        }

        return redirect()->route('admin.employees.index')->with('message', 'Actualización exitosa');
    }

    public function destroy(int $id)
    {
        $employee = $this->employeeInterface->findEmployeeById($id);
        $employeeRepo = new EmployeeRepository($employee);
        $employeeRepo->deleteEmployee();

        return redirect()->route('admin.employees.index')
            ->with('message', 'Eliminado Satisfactoriamente');
    }

    public function getProfile($id)
    {
        return view('companies::admin.employees.profile', [
            'employee' => auth()->guard('employee')->user(),
        ]);
    }

    public function updateProfile(UpdateEmployeeRequest $request, $id)
    {
        $employee = $this->employeeInterface->findEmployeeById($id);
        $update = new EmployeeRepository($employee);
        $update->updateEmployee($request->except('_token', '_method', 'password'));

        if ($request->has('password') && $request->input('password') != '') {
            $update->updateEmployee($request->only('password'));
        }

        return redirect()->route('admin.employee.profile', $id)
            ->with('message', 'Actualización Exitosa!');
    }

    public function recoverTrashedEmployee(int $id)
    {
        $employee = $this->employeeInterface->findTrashedEmployeeById($id);
        $employeeRepo = new EmployeeRepository($employee);
        $employeeRepo->recoverTrashedEmployee();

        return redirect()->route('admin.employees.index')
            ->with('message', 'Recuperación Exitosa!');
    }
}
