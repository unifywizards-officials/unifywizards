<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Services\RoleService;
use App\Services\PermissionService;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected RoleService $roleService;
    protected PermissionService $permissionService;

    public function __construct(
        RoleService $roleService,
        PermissionService $permissionService
    ) {
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;

        $this->middleware('auth');
        $this->middleware('permission:view roles')->only(['index', 'show']);
        $this->middleware('permission:create roles')->only(['create', 'store']);
        $this->middleware('permission:edit roles')->only(['edit', 'update']);
        $this->middleware('permission:delete roles')->only(['destroy']);
    }

    public function index(Request $request)
    {
        $roles = $this->roleService->getAllRoles();

        return view('admin.pages.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        $permissionGroups = $permissions->groupBy(function ($permission) {
            return $permission->group ?? 'Ungrouped';
        });

        return view('admin.pages.roles.create', compact('permissions', 'permissionGroups'));
    }

    public function store(StoreRoleRequest $request)
    {
        $data = $request->validated();
        $data['permissions'] = array_map('intval', $request->input('permissions', []));

        $result = $this->roleService->createRole($data);

        if (isset($result['success']) && $result['success']) {
            return redirect()
                ->route('admin.roles.index')
                ->with('success', $result['message']);
        }

        return back()
            ->with('error', $result['message'])
            ->withInput();
    }

    public function show($id)
    {
        $result = $this->roleService->getRoleById((int) $id);

        if (isset($result['success']) && $result['success']) {
            return view('admin.pages.roles.show', ['role' => $result['data']]);
        }

        return redirect()->route('admin.roles.index')->with('error', $result['message']);
    }

    public function edit($id)
    {
        $roleResult = $this->roleService->getRoleById((int) $id);
        $permissions = Permission::all();
        $permissionGroups = $permissions->groupBy(function ($permission) {
            return $permission->group ?? 'Ungrouped';
        });

        if (isset($roleResult['success']) && $roleResult['success']) {
            $rolePermissions = $roleResult['data']->permissions->pluck('id')->toArray();

            return view('admin.pages.roles.edit', [
                'role' => $roleResult['data'],
                'permissionGroups' => $permissionGroups,
                'permissions' => $permissions,
                'rolePermissions' => $rolePermissions,
            ]);
        }

        return redirect()->route('admin.roles.index')->with('error', $roleResult['message']);
    }

    public function update(UpdateRoleRequest $request, $id)
    {
        $data = $request->validated();
        $data['permissions'] = array_map('intval', $request->input('permissions', []));

        $result = $this->roleService->updateRole((int) $id, $data);

        if (isset($result['success']) && $result['success']) {
            return redirect()
                ->route('admin.roles.index')
                ->with('success', $result['message']);
        }

        return back()
            ->with('errors', $result['errors'] ?? [])
            ->with('error', $result['message'])
            ->withInput();
    }

    public function destroy($id)
    {
        $result = $this->roleService->deleteRole((int) $id);

        if (isset($result['success']) && $result['success']) {
            return redirect()
                ->route('admin.roles.index')
                ->with('success', $result['message']);
        }

        return back()->with('error', $result['message']);
    }
}