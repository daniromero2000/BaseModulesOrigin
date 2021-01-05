<?php

namespace Modules\CallCenter\Http\CampaignRequests\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class CampaignRequestsController extends Controller
{
    public function index()
    {
        return view('callcenter::index');
    }

    public function create()
    {
        return view('callcenter::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('callcenter::show');
    }

    public function edit($id)
    {
        return view('callcenter::edit');
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
