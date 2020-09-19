<?php

namespace Modules\CamStudio\Http\Controllers\Admin\CammodelCategories;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CamStudio\Entities\CammodelCategories\Repositories\CammodelCategoryRepository;
use Modules\CamStudio\Entities\CammodelCategories\Repositories\Interfaces\CammodelCategoryRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class CammodelCategoriesController extends Controller
{
    private $cammodelCategoryInterf;
    private $toolsInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        CammodelCategoryRepositoryInterface $cammodelCategoryInterface
    ) {
        $this->toolsInterface          = $toolRepositoryInterface;
        $this->toolsInterface          = $toolRepositoryInterface;
        $this->cammodelCategoryInterf  = $cammodelCategoryInterface;
    }

    public function index(Request $request)
    {
        if (request()->has('q')) {
            $list = $this->cammodelCategoryInterf->searchCammodelCategories(request()->input('q'));
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } elseif (request()->has('t')) {
            $list = $this->cammodelCategoryInterf->searchTrashedCammodelCategories(request()->input('t'));
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else {
            $skip = $this->toolsInterface->getSkip($request->input('skip'));
            $list = $this->cammodelCategoryInterf->listCammodelCategoriesSkip($skip * 30);
        }

        return view('camstudio::admin.cammodel-categories.list', [
            'cammodelCategories' => $list,
            'optionsRoutes' => 'admin.' . (request()->segment(2)),
            'skip' => $skip,
            'headers' => ['Nombre', 'slug', 'Estado', 'Opciones'],
        ]);
    }

    public function create()
    {
        return view('camstudio::admin.cammodel-categories.create');
    }

    public function store(Request $request)
    {
        $this->cammodelCategoryInterf->createCammodelCategory($request->except('_token', '_method'));

        return redirect()->route('admin.cammodel-categories.index')
            ->with('message', config('messaging.create'));
    }

    public function show($id)
    {
        $category = $this->cammodelCategoryInterf->findCammodelCategoryById($id);

        $cat = new CammodelCategoryRepository($category);

        return view('camstudio::admin.cammodel-categories.show', [
            'category'    => $category,
            'categories'  => $category->children,
            'products'    => $cat->findCammodelOrder()
        ]);
    }

    public function edit($id)
    {
        return view('camstudio::admin.cammodel-categories.edit', [
            'categories' => $this->cammodelCategoryInterf->listCammodelCategories('name', 'asc', $id),
            'category'  => $this->cammodelCategoryInterf->findCammodelCategoryById($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $category = $this->cammodelCategoryInterf->findCammodelCategoryById($id);

        $update = new CammodelCategoryRepository($category);
        $update->updateCammodelCategory($request->except('_token', '_method'));

        $request->session()->flash('message', config('messaging.update'));

        return redirect()->route('admin.cammodel-categories.edit', $id)->with('message', config('messaging.update'));
    }

    public function destroy(int $id)
    {
        $category = $this->cammodelCategoryInterf->findCammodelCategoryById($id);
        $category->delete();

        request()->session()->flash('message', config('messaging.delete'));
        return redirect()->route('admin.cammodel-categories.index');
    }

    public function removeImage(Request $request)
    {
        $this->cammodelCategoryInterf->deleteFile($request->only('category'));
        request()->session()->flash('message', config('messaging.delete'));
        return redirect()->route('admin.cammodel-categories.edit', $request->input('category'));
    }

    public function updateSortOrder(Request $request, int $id)
    {
        $data = $request->json();
        foreach ($data as $key => $value) {
            $res = $this->cammodelCategoryInterf->updateSortOrder($value);
        }
        return $res;
    }
}