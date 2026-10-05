<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Services\UserService;
use App\Services\RoleService;
use App\Http\Requests\User\AssignRoleRequest;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRoleController extends Controller
{
    /**
     * @var UserService
     */
    protected UserService $userService;

    /**
     * @var RoleService
     */
    protected RoleService $roleService;

    /**
     * UserRoleController constructor.
     */
    public function __construct(
        UserService $userService,
        RoleService $roleService
    ) {
        $this->userService = $userService;
        $this->roleService = $roleService;

        $this->middleware('auth');
        $this->middleware('permission:assign roles to users');
    }

    /**
     * Show roles assigned to a user.
     */
    public function showRoles($id)
    {
        $result = $this->userService->getUserById((int) $id);
        $roles = $this->roleService->getAllRolesCollection();

        if (isset($result['success']) && $result['success']) {
            return view('admin.users.roles', [
                'user' => $result['data'],
                'roles' => $roles,
            ]);
        }

        return back()->with('error', $result['message']);
    }

    /**
     * Assign roles to a user.
     */
    public function assignRoles(AssignRoleRequest $request, $id)
    {
        $data = $request->validated();

        $result = $this->userService->assignRoles((int) $id, $data['roles']);

        if (isset($result['success']) && $result['success']) {
            return redirect()
                ->back()
                ->with('success', $result['message']);
        }

        return back()->with('error', $result['message']);
    }

    /**
     * Update user's role via AJAX.
     */
    public function updateRole(Request $request, $id)
    {
        try {
            $request->validate([
                'role_id' => 'required|integer|exists:roles,id',
            ]);

            $result = $this->userService->updateRole((int) $id, (int) $request->role_id);

            // Set appropriate HTTP status code based on success
            $statusCode = $result['success'] ? 200 : 422;
            return response()->json($result, $statusCode);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'User or Role not found.',
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }
    
}