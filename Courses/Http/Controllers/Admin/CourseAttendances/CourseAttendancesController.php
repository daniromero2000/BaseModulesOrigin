<?php

namespace Modules\Courses\Http\Controllers\Admin\CourseAttendances;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Courses\Entities\CourseAttendances\Repositories\Interfaces\CourseAttendanceRepositoryInterface;

class CourseAttendancesController extends Controller
{
    private $courseAttendanceInterface;

    public function __construct(
        CourseAttendanceRepositoryInterface $courseAttendanceRepositoryInterface
    ) {
        $this->courseAttendanceInterface = $courseAttendanceRepositoryInterface;
    }

    public function index()
    {
        return view('courses::index');
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
}
