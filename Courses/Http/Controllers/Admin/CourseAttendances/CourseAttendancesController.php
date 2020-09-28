<?php

namespace Modules\Courses\Http\Controllers\Admin\CourseAttendances;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Courses\Entities\CourseAttendance\Exports\ExportCourseAttendances;
use Modules\Courses\Entities\CourseAttendances\Repositories\Interfaces\CourseAttendanceRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class CourseAttendancesController extends Controller
{
    private $courseAttendanceInterface, $toolsInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        CourseAttendanceRepositoryInterface $courseAttendanceRepositoryInterface
    ) {
        $this->courseAttendanceInterface = $courseAttendanceRepositoryInterface;
        $this->toolsInterface  = $toolRepositoryInterface;
        $this->middleware(['permission:courses, guard:employee']);
    }

    public function index(Request $request)
    {
        if (request()->has('q') && request()->input('q') != '') {
            $skip = 0;
            $list = $this->courseAttendanceInterface->searchCourseAttendance(request()->input('q'));
        } else {
            $skip = $this->toolsInterface->getSkip($request->input('skip'));
            $list = $this->courseAttendanceInterface->listCourseAttendances($skip * 30);
        }

        return view('courses::admin.courseAttendances.list', [
            'coursesAttendances'        => $list,
            'optionsRoutes'  => 'admin.' . (request()->segment(2)),
            'skip'           => $skip
        ]);
    }


    public function create()
    {
        return view('courses::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('courses::show');
    }

    public function edit($id)
    {
        return view('courses::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function exportCourseAttendances()
    {
        return Excel::download(new ExportCourseAttendances(), 'asistencias.xlsx');
    }
}
