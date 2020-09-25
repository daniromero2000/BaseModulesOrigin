<?php

namespace Modules\Courses\Http\Controllers\Front\Courses;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Courses\Entities\Courses\Repositories\Interfaces\CourseRepositoryInterface;

class CoursesFrontController extends Controller
{
    private $courseInterface;

    public function __construct(
        CourseRepositoryInterface $courseRepositoryInterface
    ) {
        $this->courseInterface = $courseRepositoryInterface;
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
        $course = $this->courseInterface->findCourseBySlug($slug);
        return view('courses::front.courses.show', ['course' => $course]);
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
