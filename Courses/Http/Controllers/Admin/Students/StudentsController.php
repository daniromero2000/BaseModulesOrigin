<?php

namespace Modules\Courses\Http\Controllers\Admin\Students;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Courses\Entities\Students\Imports\StudentImport;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Courses\Entities\Students\Repositories\Interfaces\StudentRepositoryInterface;

class StudentsController extends Controller
{
    private $studentInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        StudentRepositoryInterface $studentRepositoryInterface
    ) {
        $this->toolsInterface  = $toolRepositoryInterface;
        $this->studentInterface = $studentRepositoryInterface;
    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list = $this->studentInterface->searchStudent(request()->input('q'), $skip * 30);
            $paginate = $this->studentInterface->countStudents(request()->input('q'), '');
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list = $this->studentInterface->searchStudent(request()->input('q'), $skip * 30, $from, $to);
            $paginate = $this->studentInterface->countStudents(request()->input('q'), $from, $to);
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else {
            $paginate = $this->studentInterface->countStudents('');
            $list = $this->studentInterface->listStudents($skip * 30);
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

        return view('courses::admin.students.list', [
            'students'        => $list,
            'optionsRoutes'   => 'admin.' . (request()->segment(2)),
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
        return view('courses::admin.students.create');
    }

    public function store(Request $request)
    {

        if ($request->hasFile('cover')) {
            DB::table('students')->truncate();
            DB::table('course_student')->truncate();
            Excel::import(new StudentImport, $request->file('cover'));
        }

        return redirect()->back()->with('message', 'Datos Cargados Satisfactoriamente!');
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
}
