<?php

namespace Modules\CamStudio\Http\Controllers\Admin\Cammodels;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CamStudio\Entities\Cammodels\Repositories\Interfaces\CammodelRepositoryInterface;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class CammodelsController extends Controller
{
    private $cammodelInterface, $toolsInterface;

    public function __construct(
        CammodelRepositoryInterface $cammodelRepositoryInterface,
        CityRepositoryInterface $cityRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->toolsInterface = $toolRepositoryInterface;
        $this->cityInterface = $cityRepositoryInterface;
        $this->cammodelInterface = $cammodelRepositoryInterface;
    }

    public function index(Request $request)
    {
        if (request()->has('q')) {
            $list = $this->cammodelInterface->searchCammodel(request()->input('q'));
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } elseif (request()->has('t')) {
            $list = $this->cammodelInterface->searchTrashedCammodel(request()->input('t'));
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else {
            $skip = $this->toolsInterface->getSkip($request->input('skip'));
            $list = $this->cammodelInterface->listCammodels($skip * 30);
        }

        return view('camstudio::admin.cammodels.list', [
            'cammodels' => $list,
            'optionsRoutes' => 'admin.' . (request()->segment(2)),
            'skip' => $skip,
            'headers' => ['Id', 'Nombre', 'Email', 'Departamento', 'Estado', 'Opciones'],
        ]);
    }


    public function create()
    {
        return view('camstudio::admin.cammodels.create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        return view('camstudio::admin.cammodels.show', [
            'cammodel' => $this->cammodelInterface->findCammodelById($id),
            'cities'   => $this->cityInterface->listCities()
        ]);
    }


    public function edit($id)
    {
        return view('camstudio::admin.cammodels.edit');
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