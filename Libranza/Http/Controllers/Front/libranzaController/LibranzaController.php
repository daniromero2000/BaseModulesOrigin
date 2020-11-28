<?php

namespace Modules\Libranza\Http\Controllers\Front\libranzaController;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Modules\Leads\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use Modules\Leads\Entities\LeadInformations\Repositories\Interfaces\LeadInformationRepositoryInterface;
use Modules\Leads\Entities\LeadProducts\Repositories\Interfaces\LeadProductRepositoryInterface;

class LibranzaController extends Controller
{

    private $cityInterface;

    public function __construct(
        CityRepositoryInterface $cityRepositoryInterface,
        LeadInformationRepositoryInterface $LeadInformationRepositoryInterface,
        LeadRepositoryInterface $LeadRepositoryInterface,
        LeadProductRepositoryInterface $leadProductRepositoryInterface
    ) {
        $this->cityInterface             = $cityRepositoryInterface;
        $this->leadInterface             = $LeadRepositoryInterface;
        $this->leadInformationInterface  = $LeadInformationRepositoryInterface;
        $this->leadProductInterface      = $leadProductRepositoryInterface;

    }

    public function subForm()
    {
        return view('libranza.front.form_libranza', [
            'cities' => $this->cityInterface->listCitiesFront()
        ]);
    }

    public function creditForm()
    {
        return view('libranza.front.form_libranza', [
            'cities' => $this->cityInterface->listCitiesFront()
        ]);
    }

    public function storeProduct(Request $request)
    {
        $this->leadProductInterface->findProductForName($request->input('product_line'));
        
        return route('form-credit-libranza', ['amount' => $request->input('amount'), 'lead_product_id' => $request->input('product_line')]);
    }

    public function thankYou()
    {
        return view('libranza.front.thank_you_page');
    }

    public function index()
    {
        return view('libranza::index');
    }

    public function create()
    {
        return view('libranza::create');
    }

    public function store(Request $request)
    {
        $request->merge([
            'department_id' => 17,
            'lead_service_id' => 12,
            'lead_product_id' => $request->input('lead_product_id') ? $request->input('lead_product_id') : 14,
            'lead_channel_id' => 1
        ]);

        $lead = $this->leadInterface->createLead($request->except('_token', 'emailConfirm', 'kind_of_person', 'amount', 'term', 'entity'));
        $request->merge(['lead_id' => $lead->id]);
        $lead->leadStatus()->attach($request->input('lead_status_id'));
        $this->leadInformationInterface->createLeadInformation($request->only('lead_id',  'kind_of_person', 'amount', 'term', 'entity'));

        return redirect()->route('thank.you.page');
    }

    public function show($id)
    {
        return view('libranza::show');
    }

    public function edit($id)
    {
        return view('libranza::edit');
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
