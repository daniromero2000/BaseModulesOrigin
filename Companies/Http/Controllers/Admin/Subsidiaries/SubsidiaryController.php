<?php

namespace Modules\Companies\Http\Controllers\Admin\Subsidiaries;

use Modules\Companies\Entities\Subsidiaries\Repositories\SubsidiaryRepository;
use Modules\Companies\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use Modules\Companies\Entities\Subsidiaries\Requests\CreateSubsidiaryRequest;
use Modules\Companies\Entities\Subsidiaries\Requests\UpdateSubsidiaryRequest;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use App\Http\Controllers\Controller;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Illuminate\Http\Request;

class SubsidiaryController extends Controller
{
    private $subsidiaryInterface, $cityInterface, $toolsInterface;

    public function __construct(
        SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface,
        CityRepositoryInterface $cityRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->toolsInterface = $toolRepositoryInterface;
        $this->subsidiaryInterface = $subsidiaryRepositoryInterface;
        $this->cityInterface       = $cityRepositoryInterface;
        $this->middleware(['permission:subsidiaries, guard:employee']);
    }

    public function index(Request $request)
    {
        if (request()->has('q')) {
            $list = $this->subsidiaryInterface->searchSubsidiary(request()->input('q'));
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else if (request()->has('t')) {
            $list = $this->subsidiaryInterface->searchTrashedSubsidiary(request()->input('t'));
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else {
            $skip = $this->toolsInterface->getSkip($request->input('skip'));
            $list =  $this->subsidiaryInterface->listSubsidiaries($skip * 30);
        }

        return view('companies::admin.subsidiaries.list', [
            'subsidiaries'  =>  $list,
            'skip'          => $skip,
            'cities'        => $this->cityInterface->listCities(),
            'optionsRoutes' => 'admin.' . (request()->segment(2)),
            'headers'       => ['ID', 'Sucursal', 'Dirección', 'Telefono', 'Ciudad', 'Opciones']
        ]);
    }

    public function create()
    {
        return view('companies::admin.subsidiaries.create', [
            'cities' => $this->cityInterface->getAllCityNames(),
        ]);
    }

    public function store(CreateSubsidiaryRequest $request)
    {
        $this->subsidiaryInterface->createSubsidiary($request->except('_token', '_method'));

        return redirect()->route('admin.subsidiaries.index')
            ->with('message', 'Sucursal Creada Exitosamente!');
    }

    public function show($id)
    {
        $subsidiary = $this->subsidiaryInterface->findSubsidiaryById($id);

        return view('companies::admin.subsidiaries.show', [
            'subsidiary'   => $subsidiary,
            'subsidiaries' => $subsidiary->children,
        ]);
    }

    public function edit($id)
    {
        $subsidiary = $this->subsidiaryInterface->findSubsidiaryById($id);

        return view('companies::admin.subsidiaries.edit', [
            'subsidiary' => $subsidiary,
            'cities'     => $this->cityInterface->listCities(),
            'cityId'     => $subsidiary->city_id,
        ]);
    }

    public function update(UpdateSubsidiaryRequest $request, $id)
    {
        $update = new SubsidiaryRepository($this->subsidiaryInterface->findSubsidiaryById($id));
        $update->updateSubsidiary($request->except('_token', '_method'));
        $request->session()->flash('message', 'Actualizacion Exitosa');

        return redirect()->route('admin.subsidiaries.index');
    }


    public function destroy(int $id)
    {
        $subsidiary = new SubsidiaryRepository($this->subsidiaryInterface->findSubsidiaryById($id));
        $subsidiary->deleteSubsidiary();

        request()->session()->flash('message', 'Eliminado Satisfactoriamente');
        return redirect()->route('admin.subsidiaries.index');
    }

    public function recoverTrashedSubsidiary(int $id)
    {
        $subsidiaryRepo = new SubsidiaryRepository($this->subsidiaryInterface->findTrashedSubsidiaryById($id));
        $subsidiaryRepo->recoverTrashedSubsidiary();

        return redirect()->route('admin.subsidiaries.index')
            ->with('message', 'Recuperación Exitosa!');
    }
}
