<?php

namespace Modules\Courses\Http\Controllers\Admin\Students;

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
        if (request()->has('q') && request()->input('q') != '') {
            $skip = 0;
            $list = $this->studentInterface->searchStudent(request()->input('q'));
        } else {
            $skip = $this->toolsInterface->getSkip($request->input('skip'));
            $list = $this->studentInterface->listStudents($skip * 30);
        }

        return view('courses::admin.students.list', [
            'students'        => $list,
            'optionsRoutes'   => 'admin.' . (request()->segment(2)),
            'skip'            => $skip
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
