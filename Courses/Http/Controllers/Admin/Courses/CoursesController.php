<?php

namespace Modules\Courses\Http\Controllers\Admin\Courses;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Controller;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Courses\Entities\Courses\Repositories\CourseRepository;
use Modules\Courses\Entities\Courses\Repositories\Interfaces\CourseRepositoryInterface;

class CoursesController extends Controller
{
    private $courseInterface, $toolsInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        CourseRepositoryInterface $courseRepositoryInterface
    ) {
        $this->toolsInterface  = $toolRepositoryInterface;
        $this->courseInterface = $courseRepositoryInterface;
        $this->middleware(['permission:courses, guard:employee']);
    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list = $this->courseInterface->searchCourse(request()->input('q'), $skip * 30);
            $paginate = $this->courseInterface->countCourse(request()->input('q'),);
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list = $this->courseInterface->searchCourse(request()->input('q'), $skip * 30, $from, $to);
            $paginate = $this->courseInterface->countCourse(request()->input('q'), $from, $to);
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else {
            $paginate = $this->courseInterface->countCourse('');
            $list = $this->courseInterface->listCourses($skip * 30);
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

        return view('courses::admin.courses.list', [
            'courses'         => $list,
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
        return view('courses::admin.courses.create');
    }


    public function store(Request $request)
    {
        $data = $request->except('_token', '_method');
        $data['slug'] = str_slug($request->input('name'));

        if ($request->hasFile('cover') && $request->file('cover') instanceof UploadedFile) {
            $data['cover'] = $this->courseInterface->saveCoverImage($request->file('cover'));
        }

        if ($request->hasFile('img_welcome')) {
            $data['img_welcome'] =  $this->courseInterface->saveCoverImage($request->file('img_welcome'));
        }

        if ($request->hasFile('img_footer')) {
            $data['img_footer'] =  $this->courseInterface->saveCoverImage($request->file('img_footer'));
        }

        if ($request->hasFile('img_button')) {
            $data['img_button'] =  $this->courseInterface->saveCoverImage($request->file('img_button'));
        }

        $course = $this->courseInterface->createCourse($data);

        return redirect()->route('admin.courses.edit', $course->id)
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
            '_method'
        );
        $data['slug'] = str_slug($request->input('name'));

        if ($request->hasFile('cover')) {
            $data['cover'] = $courseRepo->saveCoverImage($request->file('cover'));
        }

        if ($request->hasFile('img_welcome')) {
            $data['img_welcome'] = $courseRepo->saveCoverImage($request->file('img_welcome'));
        }

        if ($request->hasFile('img_footer')) {
            $data['img_footer'] = $courseRepo->saveCoverImage($request->file('img_footer'));
        }

        if ($request->hasFile('img_button')) {
            $data['img_button'] = $courseRepo->saveCoverImage($request->file('img_button'));
        }

        $courseRepo->updateCourse($data);

        return redirect()->route('admin.courses.edit', $id);
    }


    public function destroy($id)
    {
        $course = $this->courseInterface->findCourseById($id);
        $course->delete();

        request()->session()->flash('message', config('messaging.delete'));
        return redirect()->route('admin.courses.index');
    }
}
