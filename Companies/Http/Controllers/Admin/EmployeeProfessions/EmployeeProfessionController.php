<?php

namespace Modules\Companies\Http\Controllers\Admin\EmployeeProfessions;

use Modules\Companies\Entities\EmployeeProfessions\Repositories\Interfaces\EmployeeProfessionRepositoryInterface;
use Modules\Companies\Entities\EmployeeProfessions\Requests\CreateEmployeeProfessionRequest;
use App\Http\Controllers\Controller;
use Modules\Companies\Entities\EmployeeStatusesLogs\Repositories\Interfaces\EmployeeStatusesLogRepositoryInterface;

class EmployeeProfessionController extends Controller
{
    private $customerProfessionInterface, $customerStatusesLogInterface;

    public function __construct(
        EmployeeProfessionRepositoryInterface $employeeProfessionRepositoryInterface,
        EmployeeStatusesLogRepositoryInterface $employeeStatusesLogRepositoryInterface
    ) {
        $this->customerProfessionInterface = $employeeProfessionRepositoryInterface;
        $this->customerStatusesLogInterface = $employeeStatusesLogRepositoryInterface;
        $this->middleware(['permission:employees, guard:employee']);
    }

    public function store(CreateEmployeeProfessionRequest $request)
    {
        $profession =  $this->customerProfessionInterface->createEmployeeProfession($request->except('_token', '_method'));

        $data = array(
            'employee_id' => $profession->employee->id,
            'status'      => 'Profesión Agregada',
            'user_id'     => auth()->guard('employee')->user()->id
        );

        $this->customerStatusesLogInterface->createEmployeeStatusesLog($data);

        $request->session()->flash('message', 'Adición de Profesión Exitosa');
        return back();
    }
}
