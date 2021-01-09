<?php

namespace Modules\CallCenter\Http\Controllers\Admin\CampaignRequests;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CallCenter\Entities\CampaignRequests\Services\Interfaces\CallCenterCampaignRequestServiceInterface;
use Illuminate\Http\UploadedFile;
use Modules\CallCenter\Entities\CampaignRequests\Requests\CreateCallCenterCampaignRequestsRequest;

class CampaignRequestController extends Controller
{
    private $callCenterCampaignRequestInterface;

    public function __construct(
        CallCenterCampaignRequestServiceInterface $callCenterCampaignRequestServiceInterface
    ) {
        $this->callCenterCampaignRequestInterface   = $callCenterCampaignRequestServiceInterface;
        // $this->middleware(['permission:actions, guard:employee']);
    }

    public function index(Request $request)
    {
        if (request()->input('id')) {
            $data = $this->callCenterCampaignRequestInterface->downloadFileCampaignRequest(request()->input('id'));
            return response()->download($data['file'], $data['name']);
        }
        
        $response = $this->callCenterCampaignRequestInterface->listCampaignRequests(['search' => request()->input()]);

        if ($response['search']) {
            $request->session()->flash('message', 'Resultado de la Busqueda');
        }

        return view('callcenter::admin.campaignRequests.list', $response['data']);
    }

    public function create()
    {
        return view('callcenter::admin.campaignRequests.create');
    }

    public function store(CreateCallCenterCampaignRequestsRequest $request)
    {
        $data = $request->except('_token', '_method');

        if ($request->hasFile('src') && $request->file('src') instanceof UploadedFile) {

            $valid = array('csv', 'xls', 'xlsx');
            if (!in_array($request->file('src')->getClientOriginalExtension(), $valid)) {
                $request->session()->flash('error', 'El archivo no es valido');
                return redirect()->back();
            }
            $data['src'] = $this->callCenterCampaignRequestInterface->saveFileCampaignRequest($request->file('src'));
        }

        $this->callCenterCampaignRequestInterface->saveCampaignRequest($data);

        return redirect()->route('admin.campaignRequests.index')->with('message', 'Creación Exitosa');
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
        $data = $request->except('_token', '_method');
        if ($request->hasFile('src') && $request->file('src') instanceof UploadedFile) {

            $valid = array('csv', 'xls', 'xlsx');
            if (!in_array($request->file('src')->getClientOriginalExtension(), $valid)) {
                $request->session()->flash('error', 'El archivo no es valido');
                return redirect()->back();
            }
            $data['src'] = $this->callCenterCampaignRequestInterface->saveFileCampaignRequest($request->file('src'));
        }

        $this->callCenterCampaignRequestInterface->updateCampaignRequest(['data' => $data, 'id' => $id]);

        return redirect()->route('admin.campaignRequests.index')->with('message', 'Actualización Exitosa');
    }

    public function destroy($id)
    {
        //
    }
}
