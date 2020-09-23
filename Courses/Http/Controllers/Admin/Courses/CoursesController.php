<?php

namespace Modules\Courses\Http\Controllers\Admin\Courses;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Courses\Entities\Courses\Repositories\Interfaces\CourseRepositoryInterface;

class CoursesController extends Controller
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
