<?php

namespace Modules\Companies\Http\Controllers\Admin\InterviewStatuses;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Companies\Entities\InterviewStatuses\Repositories\Interfaces\InterviewStatusRepositoryInterface;
use Modules\Companies\Entities\InterviewStatuses\Repositories\InterviewStatusRepository;

class InterviewStatusesController extends Controller
{
    private $interviewStatusesInterface;

    public function __construct(
        InterviewStatusRepositoryInterface $interviewStatusRepositoryInterface
    ) {
        $this->interviewStatusesInterface = $interviewStatusRepositoryInterface;
        $this->middleware(['permission:interviews, guard:employee']);
    }

    public function index()
    {
        return view('companies::admin.interview-statuses.list', [
            'interviewStatuses' => $this->interviewStatusesInterface->listInterviewStatuses(),
            'user'             => auth()->guard('employee')->user(),
            'optionsRoutes' => 'admin.' . (request()->segment(2)),
            'headers'       => ['ID', 'Nombre', 'Color', 'Opciones']
        ]);
    }

    public function create()
    {
        return view('companies::admin.interview-statuses.create');
    }

    public function store(Request $request)
    {
        if (!strpos($request['color'], '#')) {
            $request['color'] = '#' . $request['color'];
        }

        $this->interviewStatusesInterface->createInterviewStatus($request->except('_token', '_method'));
        $request->session()->flash('message', config('messaging.create'));
        return redirect()->route('admin.interview-statuses.index');
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        return view('companies::admin.interview-statuses.edit', [
            'interviewStatus' => $this->interviewStatusesInterface->findInterviewStatusById($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $update = new InterviewStatusRepository($this->interviewStatusesInterface->findInterviewStatusById($id));
        $update->updateInterviewStatus($request->all());
        $request->session()->flash('message', config('messaging.update'));

        return redirect()->route('admin.interview-statuses.edit', $id);
    }

    public function destroy($id)
    {
        $interviewStatus = new InterviewStatusRepository($this->interviewStatusesInterface->findinterviewStatusById($id));
        $interviewStatus->deleteinterviewStatus();

        request()->session()->flash('message', 'Eliminado Satisfactoriamente');
        return redirect()->route('admin.interview-statuses.index');
    }
}
