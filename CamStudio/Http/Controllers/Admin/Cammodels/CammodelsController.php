<?php

namespace Modules\CamStudio\Http\Controllers\Admin\Cammodels;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CamStudio\Entities\Cammodels\Repositories\CammodelRepository;
use Modules\CamStudio\Entities\Cammodels\Repositories\Interfaces\CammodelInterface;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class CammodelsController extends Controller
{
    private $cammodelInterf;
    private $toolsInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        CammodelInterface $CammodelInterface,
        CityRepositoryInterface $cityRepositoryInterface
    ) {
        $this->toolsInterface = $toolRepositoryInterface;
        $this->cammodelInterf = $CammodelInterface;
        $this->toolsInterface = $toolRepositoryInterface;
        $this->cityInterface = $cityRepositoryInterface;
    }

    public function index(Request $request)
    {
        if (request()->has('q')) {
            $list = $this->cammodelInterf->searchCammodel(request()->input('q'));
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } elseif (request()->has('t')) {
            $list = $this->cammodelInterf->searchTrashedCammodel(request()->input('t'));
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else {
            $skip = $this->toolsInterface->getSkip($request->input('skip'));
            $list = $this->cammodelInterf->listCammodels($skip * 30);
        }

        return view('camstudio::admin.cammodels.list', [
            'cammodels' => $list,
            'optionsRoutes' => 'admin.' . (request()->segment(2)),
            'skip' => $skip,
            'headers' => ['Id', 'Nombre', 'Edad', 'Meta', 'Manager', 'Opciones'],
        ]);
    }

    public function create()
    {
        return view('camstudio::admin.cammodels.create');
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
        return view('camstudio::admin.cammodels.show', [
            'cammodel' => $this->cammodelInterf->findCammodelById($id),
            'cities'   => $this->cityInterface->listCities(),
        ]);
    }

    public function edit($id)
    {
        return view('camstudio::admin.cammodels.edit');
    }

    public function update(Request $request, $id)
    {
        $data         = $request->except('_token', '_method');
        $data['slug'] = str_slug($request->input('nickname'));
        $cammodel     = $this->cammodelInterf->findCammodelById($id);
        $cammodelRepo = new CammodelRepository($cammodel);

        if ($request->hasFile('cover_page')) {
            $data['cover_page'] = $cammodelRepo->saveCoverPageImage($request->file('cover_page'));
        }

        $cammodelRepo->updateCammodel($data);

        return redirect()->route('admin.cammodels.show', $id)->with('message', config('messaging.update'));
    }

    public function destroy($id)
    {
    }
}