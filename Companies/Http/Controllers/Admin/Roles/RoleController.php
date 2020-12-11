<?php

namespace Modules\Companies\Http\Controllers\Admin\Roles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Companies\Entities\Permissions\Repositories\Interfaces\PermissionRepositoryInterface;
use Modules\Companies\Entities\Roles\Repositories\RoleRepository;
use Modules\Companies\Entities\Roles\Repositories\Interfaces\RoleRepositoryInterface;
use Modules\Companies\Entities\Roles\Requests\CreateRoleRequest;
use Modules\Companies\Entities\Roles\Requests\UpdateRoleRequest;

class RoleController extends Controller
{
    private $roleInterface;
    private $permissionInterface;

    public function __construct(
        RoleRepositoryInterface $roleRepositoryInterface,
        PermissionRepositoryInterface $permissionRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->toolsInterface      = $toolRepositoryInterface;
        $this->roleInterface       = $roleRepositoryInterface;
        $this->permissionInterface = $permissionRepositoryInterface;
        $this->middleware(['permission:roles, guard:employee']);
    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list = $this->roleInterface->searchRole(request()->input('q'), $skip * 30);
            $paginate = $this->roleInterface->countRoles(request()->input('q'), '');
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list = $this->roleInterface->searchRole(request()->input('q'), $skip * 30, $from, $to);
            $paginate = $this->roleInterface->countRoles(request()->input('q'), $from, $to);
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else {
            $paginate = $this->roleInterface->countRoles('');
            $list = $this->roleInterface->listRoles($skip * 30);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

        foreach ($list as $key => $value) {
            $roleRepo[$key]                    = new RoleRepository($list[$key]);
            $attachedPermissionsArrayIds[$list[$key]->id] = $roleRepo[$key]->listPermissions()->pluck('id')->all();
        }

        $listActions = [];

        foreach ($list as $key => $value) {
            foreach ($list[$key]->permission as $key2 => $value2) {
                $listActions[$list[$key]->id][$value2->display_name] = $value2->actions;
            }
        }

        foreach ($list as $key3 => $value3) {
            $actionsAttached[$list[$key3]->id] = $value3->action->pluck('id')->all();
        }

        return view('companies::admin.roles.list', [
            'roles'                       => $list,
            'user'                        => auth()->guard('employee')->user(),
            'optionsRoutes'               => 'admin.' . (request()->segment(2)),
            'permissions'                 => $this->permissionInterface->getAllPermissionNames(),
            'attachedPermissionsArrayIds' => $attachedPermissionsArrayIds,
            'headers'                     => ['ID', 'Nombre', 'Nombre Display', 'Descripción', 'Opciones',],
            'searchInputs'                => [['label' => 'Buscar', 'type' => 'text', 'name' => 'q'], ['label' => 'Desde', 'type' => 'date', 'name' => 'from'], ['label' => 'Hasta', 'type' => 'date', 'name' => 'to']],
            'skip'                        => $skip,
            'listActions'                 => $listActions,
            'actionsAttached'             => $actionsAttached,
            'paginate'                    => $getPaginate['paginate'],
            'position'                    => $getPaginate['position'],
            'page'                        => $getPaginate['page'],
            'limit'                       => $getPaginate['limit']
        ]);
    }

    public function create()
    {
        return view('companies::admin.roles.create');
    }

    public function store(CreateRoleRequest $request)
    {
        $this->roleInterface->createRole($request->except('_method', '_token'));

        return redirect()->route('admin.roles.index')
            ->with('message', 'Rol Credo Exitosamente!');
    }

    public function edit($id)
    {
        $role                        = $this->roleInterface->findRoleById($id);
        $roleRepo                    = new RoleRepository($role);
        $attachedPermissionsArrayIds = $roleRepo->listPermissions()->pluck('id')->all();

        return view('companies::admin.roles.edit', [
            'role'                        => $role,
            'permissions'                 => $this->permissionInterface->getAllPermissionNames(),
            'attachedPermissionsArrayIds' => $attachedPermissionsArrayIds
        ]);
    }

    public function update(UpdateRoleRequest $request, $id)
    {
        if ($request->has('permissions')) {
            $roleRepo = new RoleRepository($this->roleInterface->findRoleById($id));
            $roleRepo->syncPermissions($request->input('permissions'));
        }

        $this->roleInterface->updateRole($request->except('_method', '_token'), $id);

        return redirect()->route('admin.roles.index')
            ->with('message', 'Actualizado Satisfactoriamente!');
    }

    public function updateActions(Request $request, $id)
    {
        if ($request->has('actions')) {
            $roleRepo = new RoleRepository($this->roleInterface->findRoleById($id));
            $roleRepo->syncActions($request->input('actions'));
        }

        return redirect()->route('admin.roles.index')
            ->with('message', 'Actualizado Satisfactoriamente!');
    }
}
