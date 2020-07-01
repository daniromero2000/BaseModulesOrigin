<?php

namespace Modules\Companies\Http\Controllers\Admin\EmployeePhones;

use Modules\Companies\Entities\EmployeePhones\Repositories\Interfaces\EmployeePhoneRepositoryInterface;
use Modules\Companies\Entities\EmployeePhones\Requests\CreateEmployeePhoneRequest;
use App\Http\Controllers\Controller;
use Modules\Companies\Entities\EmployeeStatusesLogs\Repositories\Interfaces\EmployeeStatusesLogRepositoryInterface;

class EmployeePhoneController extends Controller
{
    private $employeePhoneInterface, $employeeStatusesLogInterface;

    public function __construct(
        EmployeePhoneRepositoryInterface $employeePhoneRepositoryInterface,
        EmployeeStatusesLogRepositoryInterface $employeeStatusesLogRepositoryInterface
    ) {
        $this->employeePhoneInterface       = $employeePhoneRepositoryInterface;
        $this->employeeStatusesLogInterface = $employeeStatusesLogRepositoryInterface;
        $this->middleware(['permission:employees, guard:employee']);
    }

    public function store(CreateEmployeePhoneRequest $request)
    {
        $phone = $this->employeePhoneInterface->createEmployeePhone($request->except('_token', '_method'));

        $data = array(
            'employee_id' => $phone->employee->id,
            'status'      => 'Teléfono Agregado',
            'user_id'     => auth()->guard('employee')->user()->id
        );

        $this->employeeStatusesLogInterface->createEmployeeStatusesLog($data);

        $request->session()->flash('message', 'Adición de Teléfono Exitosa');
        return back();
    }
}
