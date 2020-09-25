<?php

namespace Modules\Courses\Http\Controllers\Admin\Courses;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Controller;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Courses\Entities\Courses\Repositories\CourseRepository;
use Modules\Courses\Entities\Courses\Repositories\Interfaces\CourseRepositoryInterface;

class CoursesController extends Controller
{
    private $courseInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        CourseRepositoryInterface $courseRepositoryInterface
    ) {
        $this->toolsInterface  = $toolRepositoryInterface;
        $this->courseInterface = $courseRepositoryInterface;
        $this->middleware(['permission:products, guard:employee']);
    }

    public function index(Request $request)
    {
        if (request()->has('q') && request()->input('q') != '') {
            $skip = 0;
            $list = $this->courseInterface->searchCourse(request()->input('q'));
        } else {
            $skip = $this->toolsInterface->getSkip($request->input('skip'));
            $list = $this->courseInterface->listCourses($skip * 30);
        }
       
        return view('courses::admin.courses.list', [
            'courses'        => $list,
            'optionsRoutes'  => 'admin.' . (request()->segment(2)),
            'skip'           => $skip
        ]);
    }


    public function create()
    {
        return view('courses::admin.courses.create');
    }


    public function store(Request $request)
    {
        $data = $request->except('_token', '_method');
        // $data['slug'] = str_slug($request->input('name'));

        if ($request->hasFile('cover') && $request->file('cover') instanceof UploadedFile) {
            $data['cover'] = $this->courseInterface->saveCoverImage($request->file('cover'));
        }

        $course = $this->courseInterface->createCourse($data);

        return redirect()->route('admin.Courses.edit', $course->id)
            ->with('message', config('messaging.create'));
    }


    public function show($id)
    {
        return view('courses::show');
    }


    public function edit($id)
    {
        $course = $this->courseInterface->findCourseById($id);

        return view('courses::admin.courses.edit', [
            'course'  => $course
        ]);
    }


    public function update(Request $request, $id)
    {
        $course = $this->courseInterface->findCourseById($id);
        $courseRepo = new CourseRepository($course);

        $data = $request->except(
            '_token',
            '_method',
        );
        // $data['slug'] = str_slug($request->input('name'));

        if ($request->hasFile('cover')) {
            $data['cover'] = $courseRepo->saveCoverImage($request->file('cover'));
        }

        $courseRepo->updateCourse($data);

        return redirect()->route('admin.Courses.edit', $id);
    }


    public function destroy($id)
    {
        $course = $this->courseInterface->findCourseById($id);
        $course->delete();

        request()->session()->flash('message', config('messaging.delete'));
        return redirect()->route('admin.Courses.index');
    }
}
