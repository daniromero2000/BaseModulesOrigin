<?php

namespace Modules\Companies\Http\Controllers\Admin\EmployeeAddresses;

use Modules\Companies\Entities\EmployeeAddresses\Repositories\Interfaces\EmployeeAddressRepositoryInterface;
use Modules\Companies\Entities\EmployeeAddresses\Requests\CreateEmployeeAddressRequest;
use App\Http\Controllers\Controller;
use Modules\Companies\Entities\EmployeeStatusesLogs\Repositories\Interfaces\EmployeeStatusesLogRepositoryInterface;

class EmployeeAddressController extends Controller
{
    private $employeeAddressInterface, $employeeStatusesLogInterface;

    public function __construct(
        EmployeeAddressRepositoryInterface $employeeAddressRepositoryInterface,
        EmployeeStatusesLogRepositoryInterface $employeeStatusesLogRepositoryInterface
    ) {
        $this->employeeAddressInterface     = $employeeAddressRepositoryInterface;
        $this->employeeStatusesLogInterface = $employeeStatusesLogRepositoryInterface;
        $this->middleware(['permission:employees, guard:employee']);
    }

    public function store(CreateEmployeeAddressRequest $request)
    {
        $address = $this->employeeAddressInterface->createEmployeeAddress($request->except('_token', '_method'));

        $data = array(
            'employee_id' => $address->employee->id,
            'status'      => 'Dirección Agregada',
            'user_id'     => auth()->guard('employee')->user()->id
        );

        $this->employeeStatusesLogInterface->createEmployeeStatusesLog($data);

        $request->session()->flash('message', 'Adición de Residencia Exitosa!');
        return back();
    }
}
