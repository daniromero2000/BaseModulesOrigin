<?php

namespace Modules\CallCenter\Http\Controllers\Admin\Campaigns;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CallCenter\Entities\Campaigns\Services\Interfaces\CallCenterCampaignServiceInterface;
use Illuminate\Http\UploadedFile;
use Modules\CallCenter\Entities\Campaigns\Requests\CreateCallCenterCampaign;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Courses\Entities\Campaigns\Imports\CampaignImport;

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
    
        $valid = array('csv', 'xls', 'xlsx');
        if (!in_array($request->file('src')->getClientOriginalExtension(), $valid)) {
            $request->session()->flash('error', 'El archivo no es valido');
            return redirect()->back();
        }

        $campaign = $this->callCenterCampaignInterface->saveCampaign($data);
        set_time_limit(180);

        Excel::import(new CampaignImport($campaign->id), $request->file('src'));

        
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
        $this->callCenterCampaignInterface->updateCampaign(['data' => $request->except('_token', '_method'), 'id' => $id]);

        return redirect()->route('admin.campaigns.index')->with('message', 'Actualización Exitosa');
    }

    public function import(Request $request, $id)
    {
        $valid = array('csv', 'xls', 'xlsx');
        if (!in_array($request->file('src')->getClientOriginalExtension(), $valid)) {
            $request->session()->flash('error', 'El archivo no es valido');
            return redirect()->back();
        }

        set_time_limit(180);
        if($request->input('type') == 0){
            Excel::import(new CampaignImport($id), $request->file('src'));
        }else{
            $this->callCenterCampaignInterface->destroyCampaignBase($id);
            Excel::import(new CampaignImport($id), $request->file('src'));
        }

        return redirect()->route('admin.campaigns.index')->with('message', 'Cargue Exitoso');
    }

    public function destroy($id)
    {
        //
    }
}
