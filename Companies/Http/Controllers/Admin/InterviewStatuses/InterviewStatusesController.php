<?php

namespace Modules\Companies\Http\Controllers\Admin\InterviewStatuses;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InterviewStatusesController extends Controller
{
    private $interviewStatusesInterface;

    public function __construct()
    {
    }

    public function index()
    {
        return view('companies::index');
    }

    public function create()
    {
        return view('companies::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('companies::show');
    }

    public function edit($id)
    {
        return view('companies::edit');
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
