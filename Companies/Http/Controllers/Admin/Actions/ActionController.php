<?php

namespace Modules\Companies\Http\Controllers\Admin\Actions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Companies\Entities\Actions\Repositories\Interfaces\ActionRepositoryInterface;
use Modules\Companies\Entities\Actions\Repositories\ActionRepository;

class ActionController extends Controller
{
    private $actionsInterface, $toolsInterface;

    public function __construct(
        ActionRepositoryInterface $actionRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->toolsInterface   = $toolRepositoryInterface;
        $this->actionsInterface = $actionRepositoryInterface;
        $this->middleware(['permission:actions, guard:employee']);
    }

    public function index(Request $request)
    {
        if (request()->has('q')) {
            $list = $this->actionsInterface->searchAction(request()->input('q'));
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else if (request()->has('t')) {
            $list = $this->actionsInterface->searchTrashedAction(request()->input('t'));
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else {
            $skip = $this->toolsInterface->getSkip($request->input('skip'));
            $list = $this->actionsInterface->listActions($skip * 30);
        }

        return view('companies::admin.actions.list', [
            'EmployeeActions' => $list,
            'skip'            => $skip,
            'optionsRoutes'   => 'admin.' . (request()->segment(2)),
            'headers'         => ['ID',  'Modulo',  'Nombre',  'Icono',  'Ruta', 'Principal',  'Opciones',]
        ]);
    }

    public function create()
    {
        return view('companies::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('companies::show');
    }

    public function edit($id)
    {
        return view('companies::edit');
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $action     = $this->actionsInterface->findActionById($id);
        $actionRepo = new ActionRepository($action);
        $actionRepo->deleteAction();

        return redirect()->route('admin.actions.index')
            ->with('message', 'Eliminado Satisfactoriamente');
    }

    public function recoverTrashedAction(int $id)
    {
        $action  = $this->actionsInterface->findTrashedActionById($id);
        $actionRepo = new ActionRepository($action);
        $actionRepo->recoverTrashedAction();

        return redirect()->route('admin.actions.index')
            ->with('message', 'Recuperación Exitosa!');
    }
}
