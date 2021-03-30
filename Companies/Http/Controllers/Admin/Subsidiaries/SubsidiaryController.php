<?php

namespace Modules\Companies\Http\Controllers\Admin\Subsidiaries;

use Modules\Companies\Entities\Subsidiaries\Repositories\SubsidiaryRepository;
use Modules\Companies\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use Modules\Companies\Entities\Subsidiaries\Requests\CreateSubsidiaryRequest;
use Modules\Companies\Entities\Subsidiaries\Requests\UpdateSubsidiaryRequest;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
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
        $skip    = request()->input('skip') ? request()->input('skip') : 0;
        $from    = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to      = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();
        $company = auth()->guard('employee')->user()->company_id;

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list = $this->subsidiaryInterface->searchSubsidiary(request()->input('q'), $skip * 30, $company);
            $paginate = $this->subsidiaryInterface->countSubsidiaries(request()->input('q'), $company);
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list = $this->subsidiaryInterface->searchSubsidiary(request()->input('q'), $skip * 30, $company, $from, $to);
            $paginate = $this->subsidiaryInterface->countSubsidiaries(request()->input('q'), $company, $from, $to);
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else {
            $paginate = $this->subsidiaryInterface->countSubsidiaries('', $company);
            $list = $this->subsidiaryInterface->listSubsidiaries($skip * 30, $company);
        }

        $paginate = ceil($paginate  / 30);

        $skipPaginate = $skip;

        $pageList = ($skipPaginate + 1) / 5;
        if (is_int($pageList) || $pageList > 1) {
            $countPage = $skipPaginate - 5;
            $maxPage = $skipPaginate + 6 > $paginate ? intval($skipPaginate + ($paginate - $skipPaginate)) : $skipPaginate + 6;
        } else {
            $countPage = 0;
            $maxPage = $skipPaginate + 5 > $paginate ? intval($skipPaginate + ($paginate - $skipPaginate)) : $skipPaginate + 5;
        }

        return view('companies::admin.subsidiaries.list', [
            'subsidiaries'  =>  $list,
            'skip'          => $skip,
            'cities'        => $this->cityInterface->listCities(),
            'optionsRoutes' => 'admin.' . (request()->segment(2)),
            'headers'       => ['ID', 'Sucursal', 'Dirección', 'Teléfono', 'Ciudad', 'Opciones'],
            'searchInputs'    => [['label' => 'Buscar', 'type' => 'text', 'name' => 'q'], ['label' => 'Desde', 'type' => 'date', 'name' => 'from'], ['label' => 'Hasta', 'type' => 'date', 'name' => 'to']],
            'skip'          => $skip,
            'pag'           => $pageList,
            'i'             => $countPage,
            'max'           => $maxPage,
            'paginate'      => $paginate
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
        $request->merge(['company_id' => auth()->guard('employee')->user()->company_id]);

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

    public function getSubsidiariesCompanies(int $id)
    {
        return $this->subsidiaryInterface->getSubsidiaryForCompany($id);
    }
}
