<?php

namespace Modules\Libranza\Http\Controllers\Admin\Covenants;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Libranza\Entities\Covenants\Repositories\Interfaces\CovenantRepositoryInterface;

class CovenantController extends Controller
{
    private $covenantInterface, $toolsInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        CovenantRepositoryInterface $covenantRepositoryInterface
    ) {
        $this->toolsInterface          = $toolRepositoryInterface;
        $this->covenantInterface       = $covenantRepositoryInterface;
        // $this->middleware(['permission:documents, guard:employee']);
    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->covenantInterface->searchCovenant(request()->input('q'), $skip * 30);
            $paginate = $this->covenantInterface->countCovenants(request()->input('q'), '');
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->covenantInterface->searchCovenant(request()->input('q'), $skip * 30, $from, $to);
            $paginate = $this->covenantInterface->countCovenants(request()->input('q'), $from, $to);
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else {
            $paginate = $this->covenantInterface->countCovenants('');
            $list = $this->covenantInterface->listCovenants($skip * 30);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);
        return view('libranza::admin.covenants.index', [
            'covenants'          => $list,
            'skip'              => $skip,
            'headers'           => ['Nombre', 'Tipo de cliente', 'Tipo', 'Origen', 'Estado', 'Opciones'],
            'routeEdit'         => 'admin.convenios.update',
            'optionsRoutes'     => 'admin.' . (request()->segment(2)),
            'title'             => 'Documentos',
            'inputs'            => [
                ['label' => 'Nombre', 'type' => 'text', 'name' => 'covenant'],
                ['label' => 'Estado', 'type' => 'select', 'name' => 'is_active', 'options' => [['id' => 1, 'name' => 'Activo'], ['id' => '0', 'name' => 'Inactivo']], 'option' => 'name']
            ],
            'paginate'          => $getPaginate['paginate'],
            'position'          => $getPaginate['position'],
            'page'              => $getPaginate['page'],
            'limit'             => $getPaginate['limit']
        ]);
    }

    public function create()
    {
        return view('libranza::admin.covenants.create');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token', '_method');
        $this->covenantInterface->createCovenant($data);

        return redirect()->route('admin.convenios.index')->with('message', 'Creación Exitosa');
    }

    public function show($id)
    {
        return view('libranza::admin.covenants.show', [
            'covenant' => $this->covenantInterface->findCovenantById($id)
        ]);
    }

    public function edit($id)
    {
        return view('libranza::edit');
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token', '_method');
        $data['id'] = $id;
        $this->covenantInterface->updateCovenant($data);

        return redirect()->route('admin.convenios.index')->with('message', 'Actualización Exitosa');
    }

    public function destroy($id)
    {
        $this->covenantInterface->deleteCovenant($id);

        return redirect()->route('admin.convenios.index')->with('message', 'Eliminado Exitosamente');
    }
}
