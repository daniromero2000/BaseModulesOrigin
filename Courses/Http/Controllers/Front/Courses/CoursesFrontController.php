<?php

namespace Modules\Courses\Http\Controllers\Front\Courses;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Courses\Entities\Courses\Repositories\Interfaces\CourseRepositoryInterface;
use Modules\Courses\Entities\Students\Repositories\Interfaces\StudentRepositoryInterface;
use Modules\Courses\Entities\CourseAttendances\Repositories\Interfaces\CourseAttendanceRepositoryInterface;

class CoursesFrontController extends Controller
{
    private $courseInterface, $studentInterface, $courseAttendanceInterface;

    public function __construct(
        CourseRepositoryInterface $courseRepositoryInterface,
        StudentRepositoryInterface $studentRepositoryInterface,
        CourseAttendanceRepositoryInterface $courseAttendanceRepositoryInterface
    ) {
        $this->courseInterface  = $courseRepositoryInterface;
        $this->studentInterface = $studentRepositoryInterface;
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


    public function show($slug)
    {
        $student = $this->studentInterface->findStudentByIdentification(request()->input('id'));


        if (!empty($student->toArray())) {
            foreach ($student->courses as $key => $value) {
                if ($value->slug == $slug) {
                    $course = $this->courseInterface->findCourseBySlug($slug);
                    $this->courseAttendanceInterface->createCourseAttendance(['course_name' => $course->name, 'identification' => $student->identification, 'name' => $student->name, 'last_name' => $student->last_name]);
                    return view('courses::front.courses.show', ['course' => $course]);
                }
            }
        }

        request()->session()->flash('error', config('messaging.delete'));
        return redirect()->route('home');
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
