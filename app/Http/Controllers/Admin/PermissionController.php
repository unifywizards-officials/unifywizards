<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Services\PermissionService;
use App\Http\Requests\Permission\StorePermissionRequest;
use App\Http\Requests\Permission\UpdatePermissionRequest;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected PermissionService $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;

        $this->middleware('auth');
        $this->middleware('permission:view permissions')->only(['index', 'show']);
        $this->middleware('permission:create permissions')->only(['create', 'store']);
        $this->middleware('permission:edit permissions')->only(['edit', 'update']);
        $this->middleware('permission:delete permissions')->only(['destroy']);
    }

    public function index(Request $request)
    {
        $permissions = $this->permissionService->getAllPermissions();
        $groups = $this->permissionService->getPermissionGroups();

        return view('admin.pages.permissions.index', compact('permissions', 'groups'));
    }

    public function create()
    {
        $groups = $this->permissionService->getPermissionGroups();

        return view('admin.pages.permissions.create', compact('groups'));
    }

    public function store(StorePermissionRequest $request)
    {
        $data = $request->validated();

        $result = $this->permissionService->createPermission($data);

        if (isset($result['success']) && $result['success']) {
            return redirect()
                ->route('admin.permissions.index')
                ->with('success', $result['message']);
        }

        return back()
            ->with('error', $result['message'])
            ->withInput();
    }

    public function show($id)
    {
        $result = $this->permissionService->getPermissionById((int) $id);

        if (isset($result['success']) && $result['success']) {
            return view('admin.pages.permissions.show', ['permission' => $result['data']]);
        }

        return redirect()->route('admin.permissions.index')->with('error', $result['message']);
    }

    public function edit($id)
    {
        $result = $this->permissionService->getPermissionById((int) $id);
        $groups = $this->permissionService->getPermissionGroups();

        if (isset($result['success']) && $result['success']) {
            return view('admin.pages.permissions.edit', [
                'permission' => $result['data'],
                'groups' => $groups,
            ]);
        }

        return redirect()->route('admin.permissions.index')->with('error', $result['message']);
    }

    public function update(UpdatePermissionRequest $request, $id)
    {
        $data = $request->validated();

        $result = $this->permissionService->updatePermission((int) $id, $data);

        if (isset($result['success']) && $result['success']) {
            return redirect()
                ->route('admin.permissions.index')
                ->with('success', $result['message']);
        }

        return back()
            ->with('error', $result['message'])
            ->withInput();
    }

    public function destroy($id)
    {
        $result = $this->permissionService->deletePermission((int) $id);

        if (isset($result['success']) && $result['success']) {
            return redirect()
                ->route('admin.permissions.index')
                ->with('success', $result['message']);
        }

        return back()->with('error', $result['message']);
    }
}