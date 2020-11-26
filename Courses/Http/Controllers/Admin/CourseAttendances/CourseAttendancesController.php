<?php

namespace Modules\Courses\Http\Controllers\Admin\CourseAttendances;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Courses\Entities\CourseAttendances\Exports\ExportCourseAttendances;
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
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list = $this->courseAttendanceInterface->searchCourseAttendance(request()->input('q'), $skip * 30);
            $paginate = $this->courseAttendanceInterface->countCourseAttendance(request()->input('q'), '');
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list = $this->courseAttendanceInterface->searchCourseAttendance(request()->input('q'), $skip * 30, $from, $to);
            $paginate = $this->courseAttendanceInterface->countCourseAttendance(request()->input('q'), $from, $to);
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else {
            $paginate = $this->courseAttendanceInterface->countCourseAttendance('');
            $list = $this->courseAttendanceInterface->listCourseAttendances($skip * 30);
        }

        $paginate = ceil($paginate  / 30);
        $skipPaginate = $skip;

        $pageList = ($skipPaginate + 1) / 5;
        if (is_int($pageList) || $pageList > 1) {
            $countPage = $skipPaginate - 5;
            $maxPage = $skipPaginate + 6 > $paginate ? intval($skipPaginate + ($paginate - $skipPaginate)) : $skipPaginate + 6;
        } else {
            $countPage = 0;
            $maxPage = $skipPaginate + 5 > $paginate ? intval($skipPaginate + ($paginate - $skipPaginate)) : $skipPaginate + 5;
        }

        return view('courses::admin.courseAttendances.list', [
            'coursesAttendances'        => $list,
            'optionsRoutes'  => 'admin.' . (request()->segment(2)),
            'searchInputs'    => [['label' => 'Buscar', 'type' => 'text', 'name' => 'q'], ['label' => 'Desde', 'type' => 'date', 'name' => 'from'], ['label' => 'Hasta', 'type' => 'date', 'name' => 'to']],
            'skip'            => $skip,
            'pag'             => $pageList,
            'i'               => $countPage,
            'max'             => $maxPage,
            'paginate'        => $paginate
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
