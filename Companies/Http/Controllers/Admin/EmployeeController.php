<?php

namespace Modules\Companies\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Modules\Generals\Entities\IdentityTypes\Repositories\Interfaces\IdentityTypeRepositoryInterface;
use Modules\Generals\Entities\Stratums\Repositories\Interfaces\StratumRepositoryInterface;
use Modules\Generals\Entities\Housings\Repositories\Interfaces\HousingRepositoryInterface;
use Modules\Generals\Entities\Epss\Repositories\Interfaces\EpsRepositoryInterface;
use Modules\Generals\Entities\ProfessionsLists\Repositories\Interfaces\ProfessionsListRepositoryInterface;
use Modules\Companies\Entities\Admins\Requests\CreateEmployeeRequest;
use Modules\Companies\Entities\Admins\Requests\UpdateEmployeeRequest;
use Modules\Companies\Entities\Employees\Repositories\EmployeeRepository;
use Modules\Companies\Entities\Employees\Repositories\Interfaces\EmployeeRepositoryInterface;
use Modules\Companies\Entities\Roles\Repositories\Interfaces\RoleRepositoryInterface;
use Modules\Companies\Entities\Departments\Repositories\Interfaces\DepartmentRepositoryInterface;
use Modules\Companies\Entities\EmployeePositions\Repositories\Interfaces\EmployeePositionRepositoryInterface;
use Modules\Companies\Entities\EmployeeCommentaries\Repositories\Interfaces\EmployeeCommentaryRepositoryInterface;
use Modules\Companies\Entities\Employees\Exceptions\EmployeeNotFoundException;
use Modules\Companies\Entities\EmployeeStatusesLogs\Repositories\Interfaces\EmployeeStatusesLogRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;


class EmployeeController extends Controller
{
    private $employeeInterface, $roleInterface, $departmentInterface;
    private $employeePositionInterface, $employeeCommentaryInterface;
    private $employeeStatusesLogInterface, $cityInterface, $identityTypeInterface;
    private $stratumInterface, $housingInterface, $epsInterface;
    private $professionsListInterface, $toolsInterface;

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
        ToolRepositoryInterface $toolRepositoryInterface
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
        $this->middleware(['permission:employees, guard:employee']);
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
            'employees'          => $list,
            'optionsRoutes'      => 'admin.' . (request()->segment(2)),
            'skip'               => $skip,
            'headers'            => ['Id', 'Nombre', 'Apellido', 'Departamento', 'Estado', 'Opciones'],
            'roles'              => $this->roleInterface->getAllRoleNames(),
            'all_departments'    => $this->departmentInterface->getAllDepartmentNames(),
            'employee_positions' => $this->employeePositionInterface->getAllEmployeePositionNames()
        ]);
    }

    public function create()
    {
        return view('companies::admin.employees.create', [
            'roles'              => $this->roleInterface->getAllRoleNames(),
            'departments'        => $this->departmentInterface->getAllDepartmentNames(),
            'employee_positions' => $this->employeePositionInterface->getAllEmployeePositionNames()
        ]);
    }

    public function store(CreateEmployeeRequest $request)
    {
        $employee = $this->employeeInterface->createEmployee($request->all());

        $data = array(
            'employee_id' => $employee->id,
            'status'      => 'Creado',
            'user_id'     => auth()->guard('employee')->user()->id
        );

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
                'employee'               => $this->employeeInterface->findEmployeeById($id),
                'cities'                 => $this->cityInterface->listCities(),
                'identity_types'         => $this->identityTypeInterface->getAllIdentityTypesNames(),
                'stratums'               => $this->stratumInterface->getAllStratumsNames(),
                'housings'               => $this->housingInterface->getAllHousingsNames(),
                'epss'                   => $this->epsInterface->getAllEpsNames(),
                'professions_lists'      => $this->professionsListInterface->getAllProfessionsNames(),
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

        return redirect()->route('admin.employees.index')->with('message', 'Actualización exitosa');
    }

    public function destroy(int $id)
    {
        $employee     = $this->employeeInterface->findEmployeeById($id);
        $employeeRepo = new EmployeeRepository($employee);
        $employeeRepo->deleteEmployee();

        return redirect()->route('admin.employees.index')
            ->with('message', 'Eliminado Satisfactoriamente');
    }

    public function getProfile($id)
    {
        return view('companies::admin.employees.profile', [
            'employee' => $this->employeeInterface->findEmployeeById($id)
        ]);
    }

    public function updateProfile(UpdateEmployeeRequest $request, $id)
    {
        $employee = $this->employeeInterface->findEmployeeById($id);
        $update   = new EmployeeRepository($employee);
        $update->updateEmployee($request->except('_token', '_method', 'password'));

        if ($request->has('password') && $request->input('password') != '') {
            $update->updateEmployee($request->only('password'));
        }

        return redirect()->route('admin.employee.profile', $id)
            ->with('message', 'Actualización Exitosa!');
    }

    public function recoverTrashedEmployee(int $id)
    {
        $employee     = $this->employeeInterface->findTrashedEmployeeById($id);
        $employeeRepo = new EmployeeRepository($employee);
        $employeeRepo->recoverTrashedEmployee();

        return redirect()->route('admin.employees.index')
            ->with('message', 'Recuperación Exitosa!');
    }
}
