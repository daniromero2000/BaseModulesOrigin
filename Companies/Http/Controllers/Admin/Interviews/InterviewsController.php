<?php

namespace Modules\Companies\Http\Controllers\Admin\Interviews;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Companies\Entities\EmployeePositions\Repositories\Interfaces\EmployeePositionRepositoryInterface;
use Modules\Companies\Entities\Interviews\Repositories\Interfaces\InterviewRepositoryInterface;
use Modules\Companies\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class InterviewsController extends Controller
{
    private $interviewsInterface, $toolsInterface, $employeePositionInterface;
    private $subsidiaryInterface;

    public function __construct(
        InterviewRepositoryInterface $interviewRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        EmployeePositionRepositoryInterface $employeePositionRepositoryInterface,
        SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface
    ) {
        $this->interviewsInterface = $interviewRepositoryInterface;
        $this->toolsInterface = $toolRepositoryInterface;
        $this->employeePositionInterface = $employeePositionRepositoryInterface;
        $this->subsidiaryInterface = $subsidiaryRepositoryInterface;
        $this->middleware(['permission:interviews, guard:employee']);
    }

    public function index(Request $request)
    {
        if (request()->has('q')) {
            $list = $this->interviewsInterface->searchInterview(request()->input('q'));
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } elseif (request()->has('t')) {
            $list = $this->interviewsInterface->searchTrashedInterview(request()->input('t'));
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else {
            $skip = $this->toolsInterface->getSkip($request->input('skip'));
            $list = $this->interviewsInterface->listInterviews($skip * 30);
        }

        return view('companies::admin.interviews.list', [
            'interviews'         => $list,
            'optionsRoutes'      => 'admin.' . (request()->segment(2)),
            'skip'               => $skip,
            'headers'            => ['Id', 'Nombre', 'Email', 'Cargo', 'Estado', 'Opciones'],
            'employee_positions' => $this->employeePositionInterface->getAllEmployeePositionNames(),
        ]);
    }

    public function create()
    {
        return view('companies::admin.interviews.create', [
            'employee_positions' => $this->employeePositionInterface->getAllEmployeePositionNames(),
            'subsidiaries'       => $this->subsidiaryInterface->getAllSubsidiaryNames(),
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('companies::show');
    }

    public function edit($id)
    {
        return view('companies::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
