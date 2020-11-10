<?php

namespace Modules\Leads\Http\Controllers\Front;

use Modules\Leads\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Leads\Entities\LeadInformations\Repositories\Interfaces\LeadInformationRepositoryInterface;
use Modules\Leads\Entities\Leads\Requests\CreateLeadRequest;

class LeadController extends Controller
{
    private $leadInterface, $leadInformationInterface;

    public function __construct(
        LeadRepositoryInterface $LeadRepositoryInterface,
        LeadInformationRepositoryInterface $LeadInformationRepositoryInterface
    ) {
        $this->leadInterface = $LeadRepositoryInterface;
        $this->leadInformationInterface = $LeadInformationRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('leads::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('leads::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $lead = $this->leadInterface->createLead($request->except('_token', 'emailConfirm', 'kind_of_person', 'amount', 'term', 'entity'));

        $request->merge(['lead_id' => $lead->id]);

        $this->leadInformationInterface->createLeadInformation($request->only('lead_id',  'kind_of_person', 'amount', 'term', 'entity'));

        return redirect()->route('thank.you.page');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('leads::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('leads::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }


    // CreateLeadRequest

}
