<?php

namespace Modules\CallCenter\Http\Controllers\Admin\Scripts;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CallCenter\Entities\Scripts\Services\Interfaces\CallCenterScriptServiceInterface;
use Illuminate\Http\UploadedFile;
use Modules\CallCenter\Entities\Scripts\Requests\CreateCallCenterScriptsRequest;

class ScriptController extends Controller
{
    private $callCenterScriptInterface;

    public function __construct(
        CallCenterScriptServiceInterface $callCenterScriptServiceInterface
    ) {
        $this->callCenterScriptInterface   = $callCenterScriptServiceInterface;
    }

    public function index(Request $request)
    {
        $response = $this->callCenterScriptInterface->listScripts(['search' => request()->input()]);

        if ($response['search']) {
            $request->session()->flash('message', 'Resultado de la Busqueda');
        }

        return view('callcenter::admin.scripts.list', $response['data']);
    }

    public function create()
    {
        return view('callcenter::admin.scripts.create');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token', '_method');

        $this->callCenterScriptInterface->saveScript($data);

        return redirect()->route('admin.scripts.index')->with('message', 'Creación Exitosa');
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        return view('callcenter::admin.scripts.edit');
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token', '_method');

        $this->callCenterScriptInterface->updateScript(['data' => $data, 'id' => $id]);

        return redirect()->route('admin.scripts.index')->with('message', 'Actualización Exitosa');
    }

    public function destroy($id)
    {
        //
    }
}
