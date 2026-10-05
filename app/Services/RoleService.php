<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use App\Repositories\PermissionRepository;
use App\Traits\HasTransaction;
use App\Traits\HasLogger;
use App\Traits\HasResponse;
use Illuminate\Support\Collection;

class RoleService
{
    use HasTransaction, HasLogger, HasResponse;

    /**
     * @var RoleRepository
     */
    protected RoleRepository $roleRepository;

    /**
     * @var PermissionRepository
     */
    protected PermissionRepository $permissionRepository;

    /**
     * RoleService constructor.
     */
    public function __construct(
        RoleRepository $roleRepository,
        PermissionRepository $permissionRepository
    ) {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Get all roles with pagination.
     *
     * @param int $perPage
     * @return mixed
     */
    public function getAllRoles(int $perPage = 15): mixed
    {
        return $this->roleRepository->getAllPaginated($perPage);
    }

    /**
     * Get all roles as a collection.
     *
     * @return Collection
     */
    public function getAllRolesCollection(): Collection
    {
        return $this->roleRepository->getAll();
    }

    /**
     * Get a role by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getRoleById(int $id): mixed
    {
        $role = $this->roleRepository->findById($id);

        if (!$role) {
            return $this->errorResponse('Role not found.', 404);
        }

        return $this->successResponse($role, 'Role retrieved successfully.');
    }

    /**
     * Create a new role.
     *
     * @param array $data
     * @return mixed
     */
    public function createRole(array $data): mixed
    {
        if (!auth()->check() || !auth()->user()->isSuperAdmin()) {
            $data['is_super_admin'] = false;
        }

        try {
            $role = $this->executeTransaction(function () use ($data) {
                $role = $this->roleRepository->create($data);

                if (!empty($data['permissions'])) {
                    $this->roleRepository->syncPermissions($role->id, $data['permissions']);
                    $role->load('permissions');
                }

                return $role;
            });

            return $this->successResponse($role, 'Role created successfully.');
        } catch (\Exception $e) {
            $this->logError('Failed to create role: ' . $e->getMessage(), ['data' => $data]);

            return $this->errorResponse('Failed to create role. Please try again.', 500);
        }
    }

    /**
     * Update an existing role.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updateRole(int $id, array $data): mixed
    {
        if (!auth()->check() || !auth()->user()->isSuperAdmin()) {
            // Non-super-admins can never change the super-admin flag; preserve
            // whatever the role currently has instead of letting it default to
            // false (which would silently de-privilege an existing super-admin
            // role just because a lower-privileged admin edited another field).
            $existingRole = $this->roleRepository->findById($id);
            $data['is_super_admin'] = $existingRole ? (bool) $existingRole->is_super_admin : false;
        }

        try {
            $role = $this->executeTransaction(function () use ($id, $data) {
                $role = $this->roleRepository->update($id, [
                    'name' => $data['name'] ?? null,
                    'description' => $data['description'] ?? null,
                    'is_super_admin' => $data['is_super_admin'] ?? false,
                ]);

                if (array_key_exists('permissions', $data)) {
                    $permissions = $data['permissions'] ?? [];
                    $this->roleRepository->syncPermissions($role->id, $permissions);
                    $role->load('permissions');
                }

                return $role;
            });

            return $this->successResponse($role, 'Role updated successfully.');
        } catch (\Exception $e) {
            $this->logError('Failed to update role ID ' . $id . ': ' . $e->getMessage(), ['data' => $data]);

            return $this->errorResponse('Failed to update role. Please try again.', 500);
        }
    }

    /**
     * Delete a role.
     *
     * @param int $id
     * @return mixed
     */
    public function deleteRole(int $id): mixed
    {
        try {
            $role = $this->roleRepository->findById($id);

            if (!$role) {
                return $this->errorResponse('Role not found.', 404);
            }

            if ($role->is_super_admin) {
                return $this->errorResponse('Cannot delete super admin role.', 403);
            }

            $this->executeTransaction(function () use ($id) {
                $this->roleRepository->delete($id);
            });

            return $this->successResponse(null, 'Role deleted successfully.');
        } catch (\Exception $e) {
            $this->logError('Failed to delete role ID ' . $id . ': ' . $e->getMessage());

            return $this->errorResponse('Failed to delete role. Please try again.', 500);
        }
    }

    /**
     * Get permissions grouped for assignment to roles.
     *
     * @return array
     */
    public function getPermissionsForAssignment(): array
    {
        $permissions = $this->permissionRepository->getAll();

        return $permissions->groupBy('group')->toArray();
    }
}