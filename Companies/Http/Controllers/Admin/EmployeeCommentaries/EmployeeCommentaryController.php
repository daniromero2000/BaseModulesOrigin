<?php

namespace Modules\Companies\Http\Controllers\Admin\EmployeeCommentaries;

use Modules\Companies\Entities\EmployeeCommentaries\Repositories\Interfaces\EmployeeCommentaryRepositoryInterface;
use Modules\Companies\Entities\EmployeeCommentaries\Requests\CreateEmployeeCommentaryRequest;
use Modules\Companies\Entities\EmployeeStatusesLogs\Repositories\Interfaces\EmployeeStatusesLogRepositoryInterface;
use App\Http\Controllers\Controller;

class EmployeeCommentaryController extends Controller
{
    private $employeeCommentaryInterface, $employeeStatusesLogInterface;

    public function __construct(
        EmployeeCommentaryRepositoryInterface $EmployeeCommentaryRepositoryInterface,
        EmployeeStatusesLogRepositoryInterface $EmployeeStatusesLogRepositoryInterface
    ) {
        $this->employeeCommentaryInterface = $EmployeeCommentaryRepositoryInterface;
        $this->employeeStatusesLogInterface = $EmployeeStatusesLogRepositoryInterface;
        $this->middleware(['permission:employees, guard:employee']);
    }

    public function store(CreateEmployeeCommentaryRequest $request)
    {
        $user            = auth()->guard('employee')->user();
        $request['user'] = $user->name;
        $commentary      = $this->employeeCommentaryInterface->createEmployeeCommentary($request->except('_token', '_method'));

        $data = array(
            'employee_id' => $commentary->employee->id,
            'status'      => 'Comentario Agregado',
            'user_id'     => $user->id
        );

        $this->employeeStatusesLogInterface->createEmployeeStatusesLog($data);

        $request->session()->flash('message', 'Comentario Creado Exitosamente');
        return back();
    }
}
