<?php

namespace Modules\Companies\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\Companies\Entities\Admins\Requests\CreateEmployeeRequest;
use Modules\Companies\Entities\Admins\Requests\UpdateEmployeeRequest;
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
    private $employeeInterface;
    private $roleInterface;
    private $departmentInterface;
    private $employeePositionInterface;
    private $employeeCommentaryInterface;
    private $employeeStatusesLogInterface;
    private $cityInterface;
    private $identityTypeInterface;
    private $stratumInterface;
    private $housingInterface;
    private $epsInterface;
    private $professionsListInterface;
    private $toolsInterface;
    private $subsidiaryInterface;

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
        SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface
    ) {
        $this->toolsInterface = $toolRepositoryInterface;
        $this->employeeInterface = $employeeRepositoryInterface;
        $this->roleInterface = $roleRepositoryInterface;
        $this->departmentInterface = $departmentRepositoryInterface;
        $this->employeePositionInterface = $employeePositionRepositoryInterface;
        $this->employeeCommentaryInterface = $employeeCommentaryRepositoryInterface;
        $this->employeeStatusesLogInterface = $employeeStatusesLogRepositoryInterface;
        $this->cityInterface = $cityRepositoryInterface;
        $this->identityTypeInterface = $identityTypeRepositoryInterface;
        $this->stratumInterface = $stratumRepositoryInterface;
        $this->housingInterface = $housingRepositoryInterface;
        $this->epsInterface = $epsRepositoryInterface;
        $this->professionsListInterface = $professionsListRepositoryInterface;
        $this->customerInterface = $customerRepositoryInterface;
        $this->subsidiaryInterface = $subsidiaryRepositoryInterface;
    }

    public function index(Request $request)
    {
        if (request()->has('q')) {
            $list = $this->employeeInterface->searchEmployee(request()->input('q'));
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } elseif (request()->has('t')) {
            $list = $this->employeeInterface->searchTrashedEmployee(request()->input('t'));
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else {
            $skip = $this->toolsInterface->getSkip($request->input('skip'));
            $list = $this->employeeInterface->listEmployees($skip * 30);
        }

        return view('companies::admin.employees.list', [
            'employees' => $list,
            'optionsRoutes' => 'admin.'.(request()->segment(2)),
            'skip' => $skip,
            'headers' => ['Id', 'Nombre', 'Email', 'Departamento', 'Estado', 'Opciones'],
            'roles' => $this->roleInterface->getAllRoleNames(),
            'all_departments' => $this->departmentInterface->getAllDepartmentNames(),
            'employee_positions' => $this->employeePositionInterface->getAllEmployeePositionNames(),
        ]);
    }

    public function create()
    {
        return view('companies::admin.employees.create', [
            'roles' => $this->roleInterface->getAllRoleNames(),
            'departments' => $this->departmentInterface->getAllDepartmentNames(),
            'employee_positions' => $this->employeePositionInterface->getAllEmployeePositionNames(),
            'subsidiaries' => $this->subsidiaryInterface->getAllSubsidiaryNames(),
        ]);
    }

    public function store(CreateEmployeeRequest $request)
    {
        $customer = $this->customerInterface->createCustomer($request->except('_token', '_method'));
        /*$d = [
            '_token' => $request->_token,
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'employee_position_id' => $request->employee_position_id,
            'department_id' => $request->department_id,
            'password' => $request->password,
            'role' => $request->role,
            'customer_id' => $customer->id,
        ];*/
        //$employee = $this->employeeInterface->createEmployee($d);
        //$employee = $this->employeeInterface->createEmployee($request->all() + ['customer_id' => $customer->id]);
        $employee = $this->employeeInterface->createEmployee($request->all());

        $data = [
            'employee_id' => $employee->id,
            'status' => 'Creado',
            'user_id' => auth()->guard('employee')->user()->id,
        ];

        $this->employeeStatusesLogInterface->createEmployeeStatusesLog($data);

        if ($request->has('role')) {
            $employeeRepo = new EmployeeRepository($employee);
            $employeeRepo->syncRoles([$request->input('role')]);
        }

        return redirect()->route('admin.employees.index')
            ->with('message', 'Empleado Creado Exitosamente!');
    }

    public function show(int $id)
    {
        try {
            return view('companies::admin.employees.show', [
                'employee' => $this->employeeInterface->findEmployeeById($id),
                'cities' => $this->cityInterface->listCities(),
                'identity_types' => $this->identityTypeInterface->getAllIdentityTypesNames(),
                'stratums' => $this->stratumInterface->getAllStratumsNames(),
                'housings' => $this->housingInterface->getAllHousingsNames(),
                'epss' => $this->epsInterface->getAllEpsNames(),
                'professions_lists' => $this->professionsListInterface->getAllProfessionsNames(),
                'employee_positions' => $this->employeePositionInterface->getAllEmployeePositionNames(),
                'all_departments' => $this->departmentInterface->getAllDepartmentNames(),
                'roles' => $this->roleInterface->getAllRoleNames(),
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
        $employee = $this->employeeInterface->findEmployeeById($id);
        $isCurrentUser = $this->employeeInterface->isAuthUser($employee);
        $empRepo = new EmployeeRepository($employee);
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
