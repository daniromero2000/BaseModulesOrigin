<?php

namespace Modules\CamStudio\Http\Controllers\Admin\CammodelStreamAccounts;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CammodelStreamAccountsController extends Controller
{
    private $cammmodelStreamAccountsInterface;

    public function __construct()
    {
    }

    public function index()
    {
        return view('camstudio::index');
    }

    public function create()
    {
        return view('camstudio::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('camstudio::show');
    }

    public function edit($id)
    {
        return view('camstudio::edit');
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
