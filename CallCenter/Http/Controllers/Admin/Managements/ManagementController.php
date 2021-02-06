<?php

namespace Modules\CallCenter\Http\Controllers\Admin\Managements;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CallCenter\Entities\Managements\Services\Interfaces\CallCenterManagementServiceInterface;

class ManagementController extends Controller
{
    private $callCenterManagementInterface;

    public function __construct(
        CallCenterManagementServiceInterface $callCenterManagementServiceInterface
    ) {
        $this->callCenterManagementInterface   = $callCenterManagementServiceInterface;
    }

    public function index(Request $request)
    {
        return view('callcenter::admin.managements.management');
    }

    public function create()
    {
        return view('callcenter::admin.questionnaires.create');
    }

    public function store(Request $request)
    {
        $this->callCenterManagementInterface->saveManagement($request->except('_token', '_method'));
        return response()->json(true);
    }

    public function show($id)
    {
        return view('callcenter::admin.questionnaires.show', ['id' => $id]);
    }

    public function findManagement($id)
    {
        // return $this->callCenterManagementInterface->showManagement($id);
    }

    public function edit($id)
    {
        return view('callcenter::admin.questionnaires.edit');
    }

    public function update(Request $request, $id)
    {
        $this->callCenterManagementInterface->updateManagement($request->except('_token', '_method'));
        return response()->json(true);
    }

    public function destroy($id)
    {
        //
    }
}
