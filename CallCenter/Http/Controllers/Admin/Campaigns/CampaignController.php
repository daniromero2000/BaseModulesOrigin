<?php

namespace Modules\CallCenter\Http\Controllers\Admin\Campaigns;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CallCenter\Entities\Campaigns\Services\Interfaces\CallCenterCampaignServiceInterface;
use Illuminate\Http\UploadedFile;
use Modules\CallCenter\Entities\Campaigns\Requests\CreateCallCenterCampaign;

class CampaignController extends Controller
{
    private $callCenterCampaignInterface;

    public function __construct(
        CallCenterCampaignServiceInterface $callCenterCampaignServiceInterface
    ) {
        $this->callCenterCampaignInterface   = $callCenterCampaignServiceInterface;
    }

    public function index(Request $request)
    {
        if (request()->input('id')) {
            $data = $this->callCenterCampaignInterface->downloadFileCampaign(request()->input('id'));
            return response()->download($data['file'], $data['name']);
        }

        $response = $this->callCenterCampaignInterface->listCampaigns(['search' => request()->input()]);

        if ($response['search']) {
            $request->session()->flash('message', 'Resultado de la Busqueda');
        }

        return view('callcenter::admin.campaigns.list', $response['data']);
    }

    public function create()
    {
        return view(
            'callcenter::admin.campaigns.create',
            $this->callCenterCampaignInterface->getDataCreate()
        );
    }

    public function store(CreateCallCenterCampaign $request)
    {
        $data = $request->except('_token', '_method');

        if ($request->hasFile('src') && $request->file('src') instanceof UploadedFile) {
            $valid = array('csv', 'xls', 'xlsx');
            if (!in_array($request->file('src')->getClientOriginalExtension(), $valid)) {
                $request->session()->flash('error', 'El archivo no es valido');
                return redirect()->back();
            }
        }

        $this->callCenterCampaignInterface->saveCampaign($data);

        return redirect()->route('admin.campaigns.index')->with('message', 'Creación Exitosa');
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        return view('callcenter::admin.campaigns.edit');
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
            $data['src'] = $this->callCenterCampaignInterface->saveFileCampaign($request->file('src'));
        }

        $this->callCenterCampaignInterface->updateCampaign(['data' => $data, 'id' => $id]);

        return redirect()->route('admin.campaigns.index')->with('message', 'Actualización Exitosa');
    }

    public function destroy($id)
    {
        //
    }
}
