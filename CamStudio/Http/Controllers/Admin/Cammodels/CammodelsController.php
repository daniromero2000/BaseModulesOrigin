<?php

namespace Modules\CamStudio\Http\Controllers\Admin\Cammodels;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CamStudio\Entities\CammodelCategories\Repositories\Interfaces\CammodelCategoryRepositoryInterface;
use Modules\CamStudio\Entities\Cammodels\Repositories\CammodelRepository;
use Modules\CamStudio\Entities\Cammodels\Repositories\Interfaces\CammodelRepositoryInterface;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class CammodelsController extends Controller
{
    private $cammodelInterf, $cammodelCategoryInterf;
    private $toolsInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        CammodelRepositoryInterface $CammodelRepositoryInterface,
        CammodelCategoryRepositoryInterface $cammodelCategoryInterface,
        CityRepositoryInterface $cityRepositoryInterface
    ) {
        $this->toolsInterface          = $toolRepositoryInterface;
        $this->cammodelInterf          = $CammodelRepositoryInterface;
        $this->toolsInterface          = $toolRepositoryInterface;
        $this->cityInterface           = $cityRepositoryInterface;
        $this->cammodelCategoryInterf  = $cammodelCategoryInterface;
        $this->middleware(['permission:cam_models, guard:employee']);
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
            'headers' => ['Id', 'Nombre', 'Nickname', 'Edad', 'Manager', 'Opciones'],
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
        $cammodel = $this->cammodelInterf->findCammodelById($id);
        return view('camstudio::admin.cammodels.show', [
            'cammodel'    => $cammodel,
            'images'      => $cammodel->images()->get(['src']),
            'cities'      => $this->cityInterface->listCities(),
            'categories'  => $this->cammodelCategoryInterf->listCammodelCategories('name', 'asc')->toTree(),
            'selectedIds' => $cammodel->categories()->pluck('cammodel_id')->all()
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

        $data = $request->except(
            'categories',
            '_token',
            '_method',
        );

        if ($request->hasFile('cover_page')) {
            $data['cover_page'] = $cammodelRepo->saveCoverPageImage($request->file('cover_page'));
        }

        if ($request->hasFile('cover')) {
            $data['cover'] = $cammodelRepo->saveCoverPageImage($request->file('cover'));
        }

        if ($request->hasFile('image')) {
            $cammodelRepo->saveCammodelImages(collect($request->file('image')));
        }

        if ($request->hasFile('image_tks')) {
            $data['image_tks'] = $cammodelRepo->saveCoverPageImage($request->file('image_tks'));
        }

        if ($request->has('categories')) {
            $cammodelRepo->syncCategories($request->input('categories'));
        } else {

            $cammodelRepo->detachCategories();
        }

        $cammodelRepo->updateCammodel($data);

        return redirect()->route('admin.cammodels.show', $id)->with('message', config('messaging.update'));
    }

    public function destroy($id)
    {
    }

    public function removeThumbnail(Request $request)
    {
        $this->cammodelInterf->deleteThumb($request->input('src'));
        return redirect()->back()->with('message', config('messaging.delete'));
    }
}
