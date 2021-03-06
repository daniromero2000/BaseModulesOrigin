<?php

namespace Modules\Companies\Http\Controllers\Admin\Permissions;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Modules\Companies\Entities\Permissions\Repositories\PermissionRepository;
use Modules\Companies\Entities\Permissions\Repositories\Interfaces\PermissionRepositoryInterface;
use Modules\Companies\Entities\Permissions\Requests\CreatePermissionRequest;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    private $permissionInterface, $toolsInterface;

    public function __construct(
        PermissionRepositoryInterface $permissionRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->toolsInterface = $toolRepositoryInterface;
        $this->permissionInterface = $permissionRepositoryInterface;
        $this->middleware(['permission:permissions, guard:employee']);
    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list = $this->permissionInterface->searchPermission(request()->input('q'), $skip * 30);
            $paginate = $this->permissionInterface->countPermission(request()->input('q'), '');
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list = $this->permissionInterface->searchPermission(request()->input('q'), $skip * 30, $from, $to);
            $paginate = $this->permissionInterface->countPermission(request()->input('q'), $from, $to);
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else {
            $paginate = $this->permissionInterface->countPermission('');
            $list = $this->permissionInterface->listPermissions($skip * 30);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

        return view('companies::admin.permissions.list', [
            'permissions'   => $list,
            'optionsRoutes' => 'admin.' . (request()->segment(2)),
            'skip'          => $skip,
            'searchInputs'  => [['label' => 'Buscar', 'type' => 'text', 'name' => 'q'], ['label' => 'Desde', 'type' => 'date', 'name' => 'from'], ['label' => 'Hasta', 'type' => 'date', 'name' => 'to']],
            'headers'       => ['ID', 'Nombre', 'Nombre Display',  'Icono', 'Descripci??n', 'Opciones',],
            'skip'          => $skip,
            'paginate'      => $getPaginate['paginate'],
            'position'      => $getPaginate['position'],
            'page'          => $getPaginate['page'],
            'limit'         => $getPaginate['limit']
        ]);
    }

    public function create()
    {
        return view('companies::admin.permissions.create', []);
    }

    public function store(CreatePermissionRequest $request)
    {
        $this->permissionInterface->createPermission($request->all());

        return redirect()->route('admin.permissions.index')->with('message', 'Permiso Creado Exitosamente!');
    }

    public function destroy(int $id)
    {
        $permissionRepo = new PermissionRepository($this->permissionInterface->findPermissionById($id));
        $permissionRepo->deletePermission();

        return redirect()->route('admin.permissions.index')
            ->with('message', 'Eliminado Satisfactoriamente');
    }

    public function recoverTrashedPermission(int $id)
    {
        $PermissionRepo = new PermissionRepository($this->permissionInterface->findTrashedPermissionById($id));
        $PermissionRepo->recoverTrashedPermission();

        return redirect()->route('admin.permissions.index')
            ->with('message', 'Recuperaci??n Exitosa!');
    }
}
