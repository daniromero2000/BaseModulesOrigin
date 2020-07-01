<?php

namespace Modules\Companies\Http\Controllers\Admin\EmployeeIdentities;

use Modules\Companies\Entities\EmployeeIdentities\Repositories\Interfaces\EmployeeIdentityRepositoryInterface;
use Modules\Companies\Entities\EmployeeIdentities\Requests\CreateEmployeeIdentityRequest;
use App\Http\Controllers\Controller;
use Modules\Companies\Entities\EmployeeStatusesLogs\Repositories\Interfaces\EmployeeStatusesLogRepositoryInterface;

class EmployeeIdentityController extends Controller
{
    private $employeeIdentityInterface, $employeeStatusesLogInterface;

    public function __construct(
        EmployeeIdentityRepositoryInterface $employeeIdentityRepositoryInterface,
        EmployeeStatusesLogRepositoryInterface $employeeStatusesLogRepositoryInterface
    ) {
        $this->employeeIdentityInterface    = $employeeIdentityRepositoryInterface;
        $this->employeeStatusesLogInterface = $employeeStatusesLogRepositoryInterface;
        $this->middleware(['permission:employees, guard:employee']);
    }

    public function store(CreateEmployeeIdentityRequest $request)
    {
        $identity = $this->employeeIdentityInterface->createEmployeeIdentity($request->except('_token', '_method'));

        $data = array(
            'employee_id' => $identity->employee->id,
            'status'      => 'Identidad Agregada',
            'user_id'     => auth()->guard('employee')->user()->id
        );

        $this->employeeStatusesLogInterface->createEmployeeStatusesLog($data);

        $request->session()->flash('message', 'Adición de Identidad Exitosa');
        return back();
    }
}
