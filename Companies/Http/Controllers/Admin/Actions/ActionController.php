<?php

namespace Modules\Companies\Http\Controllers\Admin\Actions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
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
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list = $this->actionsInterface->searchAction(request()->input('q'), $skip * 30);
            $paginate = $this->actionsInterface->countAction(request()->input('q'),);
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list = $this->actionsInterface->searchAction(request()->input('q'), $skip * 30, $from, $to);
            $paginate = $this->actionsInterface->countAction(request()->input('q'), $from, $to);
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else {
            $paginate = $this->actionsInterface->countAction('');
            $list = $this->actionsInterface->listActions($skip * 30);
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

        return view('companies::admin.actions.list', [
            'EmployeeActions' => $list,
            'optionsRoutes'   => 'admin.' . (request()->segment(2)),
            'headers'         => ['ID',  'Módulo',  'Nombre',  'Ícono',  'Ruta', 'Principal',  'Opciones',],
            'skip'            => $skip,
            'pag'             => $pageList,
            'i'               => $countPage,
            'max'             => $maxPage,
            'paginate'        => $paginate
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
        $action  = $this->actionsInterface->searchTrashedAction($id);
        $actionRepo = new ActionRepository($action);
        $actionRepo->recoverTrashedAction();

        return redirect()->route('admin.actions.index')
            ->with('message', 'Recuperación Exitosa!');
    }
}
