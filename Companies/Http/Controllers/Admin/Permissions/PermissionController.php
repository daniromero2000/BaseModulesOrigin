<?php

namespace Modules\Companies\Http\Controllers\Admin\Permissions;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use App\Http\Controllers\Controller;
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
        if (request()->has('q')) {
            $list = $this->permissionInterface->searchPermission(request()->input('q'));
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else if (request()->has('t')) {
            $list = $this->permissionInterface->searchTrashedPermission(request()->input('t'));
            $request->session()->flash('message', 'Resultado de la Busqueda');
        }
        else {
            $skip = $this->toolsInterface->getSkip($request->input('skip'));
            $list = $this->permissionInterface->listPermissions($skip * 30);
        }

        return view('companies::admin.permissions.list', [
            'permissions'   => $list,
            'optionsRoutes' => 'admin.' . (request()->segment(2)),
            'skip'          => $skip,
            'headers'       => ['ID', 'Nombre', 'Nombre Display',  'Ícono', 'Descripción', 'Opciones',]
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
            ->with('message', 'Recuperación Exitosa!');
    }
}
