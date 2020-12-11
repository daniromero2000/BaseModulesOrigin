<?php

namespace Modules\Companies\Http\Controllers\Admin\Actions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Companies\Entities\Actions\Repositories\Interfaces\ActionRepositoryInterface;
use Modules\Companies\Entities\Actions\Repositories\ActionRepository;
use Modules\Companies\Entities\Permissions\Repositories\Interfaces\PermissionRepositoryInterface;

class ActionController extends Controller
{
    private $actionsInterface, $toolsInterface, $permissionInterface;

    public function __construct(
        ActionRepositoryInterface $actionRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        PermissionRepositoryInterface $permissionRepositoryInterface
    ) {
        $this->toolsInterface   = $toolRepositoryInterface;
        $this->actionsInterface = $actionRepositoryInterface;
        $this->permissionInterface = $permissionRepositoryInterface;
        $this->middleware(['permission:actions, guard:employee']);
    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list = $this->actionsInterface->searchAction(request()->input('q'), $skip * 30);
            $paginate = $this->actionsInterface->countAction(request()->input('q'), '');
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list = $this->actionsInterface->searchAction(request()->input('q'), $skip * 30, $from, $to);
            $paginate = $this->actionsInterface->countAction(request()->input('q'), $from, $to);
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else {
            $paginate = $this->actionsInterface->countAction('');
            $list = $this->actionsInterface->listActions($skip * 30);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

        return view('companies::admin.actions.list', [
            'EmployeeActions' => $list,
            'optionsRoutes'   => 'admin.' . (request()->segment(2)),
            'searchInputs'    => [['label' => 'Buscar', 'type' => 'text', 'name' => 'q'], ['label' => 'Desde', 'type' => 'date', 'name' => 'from'], ['label' => 'Hasta', 'type' => 'date', 'name' => 'to']],
            'headers'         => ['ID',  'Módulo',  'Nombre',  'Ícono',  'Ruta', 'Principal',  'Opciones',],
            'skip'            => $skip,
            'paginate'        => $getPaginate['paginate'],
            'position'        => $getPaginate['position'],
            'page'            => $getPaginate['page'],
            'limit'           => $getPaginate['limit']
        ]);
    }

    public function create()
    {
        return view('companies::admin.actions.create', [
            'permissions'     => $this->permissionInterface->getAllPermissionNames()
        ]);
    }

    public function store(Request $request)
    {
        $this->actionsInterface->createAction($request->except('_token'));

        return redirect()->route('admin.actions.index')
            ->with('message', 'Accion creada exitosamente!');
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
}
