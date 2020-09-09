<?php

namespace Modules\CamStudio\Http\Controllers\Admin\CammodelBannedCountries;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

use Modules\CamStudio\Entities\CammodelBannedCountries\CammodelBannedCountry;
use Modules\CamStudio\Entities\CammodelBannedCountries\Repositories\CammodelBannedCountryRepository;
use Modules\CamStudio\Entities\CammodelBannedCountries\Repositories\Interfaces\CammodelBannedCountryInterface;
use Modules\CamStudio\Entities\CammodelBannedCountries\Requests\CreateCammodelBannedCountryRequest;


class CammodelBannedCountryController extends Controller
{
    private $toolsInterface, $bannedCountryInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        CammodelBannedCountryInterface $cammodelBannedCountryInterface
    ) {
        $this->toolsInterface           =   $toolRepositoryInterface;
        $this->bannedCountryInterface   =   $cammodelBannedCountryInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /* if (request()->has('q')) {
            //$list = $this->cammodelInterface->searchCammodel(request()->input('q'));
            //$request->session()->flash('message', 'Resultado de la Busqueda');
        } elseif (request()->has('t')) {
            //$list = $this->cammodelInterface->searchTrashedCammodel(request()->input('t'));
            //$request->session()->flash('message', 'Resultado de la Busqueda');
        } else {
            //$skip = $this->toolsInterface->getSkip($request->input('skip'));
            //$list = $this->cammodelInterface->listCammodels($skip * 30);
        } */
        $skip = $this->toolsInterface->getSkip($request->input('skip'));
        $list = $this->bannedCountryInterface->listCammodelBannedCountryies($skip * 30);
        
        return view('camstudio::admin.cammodel-banned-countries.list', [
            'bannedCuntries' => $list,
            'optionsRoutes' => 'admin.' . (request()->segment(2)),
            'skip' => $skip,
            'headers' => ['Id', 'Pais', 'Modelo'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /* public function create()
    {
        //
    } */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /* public function store(Request $request)
    {
        //
    } */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /* public function show($id)
    {
        //
    } */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /* public function edit($id)
    {
        //
    } */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /* public function update(Request $request, $id)
    {
        //
    } */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /* public function destroy($id)
    {
        //
    } */
}
