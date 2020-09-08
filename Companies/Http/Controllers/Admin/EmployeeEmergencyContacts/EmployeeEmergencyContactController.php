<?php

namespace Modules\Companies\Http\Controllers\Admin\EmployeeEmergencyContacts;

use App\Http\Controllers\Controller;
use Modules\Companies\Entities\EmployeeEmergencyContacts\Repositories\Interfaces\EmployeeEmergencyContactRepositoryInterface;
use Modules\Companies\Entities\EmployeeEmergencyContacts\Requests\CreateEmployeeEmergencyContactRequest;
use Modules\Companies\Entities\EmployeeStatusesLogs\Repositories\Interfaces\EmployeeStatusesLogRepositoryInterface;

class EmployeeEmergencyContactController extends Controller
{
    private $employeeEmergencyContactInterface;
    private $employeeStatusesLogInterface;

    public function __construct(
        EmployeeEmergencyContactRepositoryInterface $employeeEmergencyContactRepositoryInterface,
        EmployeeStatusesLogRepositoryInterface $employeeStatusesLogRepositoryInterface
    ) {
        $this->employeeEmergencyContactInterface = $employeeEmergencyContactRepositoryInterface;
        $this->employeeStatusesLogInterface = $employeeStatusesLogRepositoryInterface;
        $this->middleware(['permission:employees, guard:employee']);
    }

    public function store(CreateEmployeeEmergencyContactRequest $request)
    {
        $emergencycontact = $this->employeeEmergencyContactInterface->createEmployeeEmergencyContact($request->except('_token', '_method'));

        $data = [
            'employee_id' => $emergencycontact->employee->id,
            'status' => 'Contacto de Emergencia Agregado',
            'user_id' => auth()->guard('employee')->user()->id,
        ];

        $this->employeeStatusesLogInterface->createEmployeeStatusesLog($data);

        $request->session()->flash('message', 'Adición de Contacto de Emergencia Exitosa!');

        return back();
    }
}
