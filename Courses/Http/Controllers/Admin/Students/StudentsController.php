<?php

namespace Modules\Courses\Http\Controllers\Admin\Students;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Courses\Entities\Students\Repositories\Interfaces\StudentRepositoryInterface;

class StudentsController extends Controller
{
    private $studentInterface;

    public function __construct(
        StudentRepositoryInterface $studentRepositoryInterface
    ) {
        $this->studentInterface = $studentRepositoryInterface;
    }

    public function index()
    {
        return view('courses::index');
    }

    public function create()
    {
        return view('courses::admin.students.create');
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
