<?php

namespace Modules\Companies\Http\Controllers\Admin\EmployeeEmails;

use Modules\Companies\Entities\EmployeeEmails\Repositories\Interfaces\EmployeeEmailRepositoryInterface;
use Modules\Companies\Entities\EmployeeEmails\Requests\CreateEmployeeEmailRequest;
use App\Http\Controllers\Controller;
use Modules\Companies\Entities\EmployeeStatusesLogs\Repositories\Interfaces\EmployeeStatusesLogRepositoryInterface;

class EmployeeEmailController extends Controller
{
    private $employeeEmailInterface, $employeeStatusesLogInterface;

    public function __construct(
        EmployeeEmailRepositoryInterface $employeeEmailRepositoryInterface,
        EmployeeStatusesLogRepositoryInterface $employeeStatusesLogRepositoryInterface
    ) {
        $this->employeeEmailInterface       = $employeeEmailRepositoryInterface;
        $this->employeeStatusesLogInterface = $employeeStatusesLogRepositoryInterface;
        $this->middleware(['permission:employees, guard:employee']);
    }

    public function store(CreateEmployeeEmailRequest $request)
    {
        $email = $this->employeeEmailInterface->createEmployeeEmail($request->except('_token', '_method'));

        $data = array(
            'employee_id' => $email->employee->id,
            'status'      => 'Email Agregado',
            'user_id'     => auth()->guard('employee')->user()->id
        );

        $this->employeeStatusesLogInterface->createEmployeeStatusesLog($data);

        $request->session()->flash('message', 'Adición de Email Exitosa');
        return back();
    }
}
