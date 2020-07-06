<?php

namespace Modules\Companies\Http\Controllers\Admin\EmployeeEpss;

use Modules\Companies\Entities\EmployeeEpss\Repositories\Interfaces\EmployeeEpsRepositoryInterface;
use Modules\Companies\Entities\EmployeeEpss\Requests\CreateEmployeeEpsRequest;
use App\Http\Controllers\Controller;
use Modules\Companies\Entities\EmployeeStatusesLogs\Repositories\Interfaces\EmployeeStatusesLogRepositoryInterface;

class EmployeeEpsController extends Controller
{
    private $employeeEpsInterface, $employeeStatusesLogInterface;

    public function __construct(
        EmployeeEpsRepositoryInterface $employeeEpsRepositoryInterface,
        EmployeeStatusesLogRepositoryInterface $employeeStatusesLogRepositoryInterface
    ) {
        $this->employeeEpsInterface = $employeeEpsRepositoryInterface;
        $this->employeeStatusesLogInterface = $employeeStatusesLogRepositoryInterface;
        $this->middleware(['permission:employees, guard:employee']);
    }

    public function store(CreateEmployeeEpsRequest $request)
    {
        $eps = $this->employeeEpsInterface->createEmployeeEps($request->except('_token', '_method'));

        $data = array(
            'employee_id' => $eps->employee->id,
            'status'      => 'Eps Agregada',
            'user_id'     => auth()->guard('employee')->user()->id
        );

        $this->employeeStatusesLogInterface->createEmployeeStatusesLog($data);

        $request->session()->flash('message', 'Adición de Teléfono Exitosa');
        return back();
    }
}
