<?php

namespace App\Services;

use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Traits\HasTransaction;
use App\Traits\HasLogger;
use App\Traits\HasResponse;
use Illuminate\Support\Collection;

class PermissionService
{
    use HasTransaction, HasLogger, HasResponse;

    /**
     * @var PermissionRepository
     */
    protected PermissionRepository $permissionRepository;

    /**
     * @var RoleRepository
     */
    protected RoleRepository $roleRepository;

    /**
     * PermissionService constructor.
     */
    public function __construct(
        PermissionRepository $permissionRepository,
        RoleRepository $roleRepository
    ) {
        $this->permissionRepository = $permissionRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Get all permissions with pagination.
     *
     * @param int $perPage
     * @return mixed
     */
    public function getAllPermissions(int $perPage = 15): mixed
    {
        return $this->permissionRepository->getAllPaginated($perPage);
    }

    /**
     * Get all permissions as a grouped collection.
     *
     * @return Collection
     */
    public function getAllPermissionsGrouped(): Collection
    {
        return $this->permissionRepository->getGrouped();
    }

    /**
     * Get all permission groups.
     *
     * @return array
     */
    public function getPermissionGroups(): array
    {
        return $this->permissionRepository->getGroups();
    }

    /**
     * Get a permission by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getPermissionById(int $id): mixed
    {
        $permission = $this->permissionRepository->findById($id);

        if (!$permission) {
            return $this->errorResponse('Permission not found.', 404);
        }

        return $this->successResponse($permission, 'Permission retrieved successfully.');
    }

    /**
     * Create a new permission.
     *
     * @param array $data
     * @return mixed
     */
    public function createPermission(array $data): mixed
    {
        try {
            $permission = $this->executeTransaction(function () use ($data) {
                return $this->permissionRepository->create([
                    'name' => $data['name'],
                    'group' => $data['group'] ?? null,
                    'description' => $data['description'] ?? null,
                    'guard_name' => $data['guard_name'] ?? 'web',
                ]);
            });

            return $this->successResponse($permission, 'Permission created successfully.');
        } catch (\Exception $e) {
            $this->logError('Failed to create permission: ' . $e->getMessage(), ['data' => $data]);

            return $this->errorResponse('Failed to create permission. Please try again.', 500);
        }
    }

    /**
     * Update an existing permission.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updatePermission(int $id, array $data): mixed
    {
        try {
            $permission = $this->executeTransaction(function () use ($id, $data) {
                return $this->permissionRepository->update($id, [
                    'name' => $data['name'] ?? null,
                    'group' => $data['group'] ?? null,
                    'description' => $data['description'] ?? null,
                    'guard_name' => $data['guard_name'] ?? 'web',
                ]);
            });

            return $this->successResponse($permission, 'Permission updated successfully.');
        } catch (\Exception $e) {
            $this->logError('Failed to update permission ID ' . $id . ': ' . $e->getMessage(), ['data' => $data]);

            return $this->errorResponse('Failed to update permission. Please try again.', 500);
        }
    }

    /**
     * Delete a permission.
     *
     * @param int $id
     * @return mixed
     */
    public function deletePermission(int $id): mixed
    {
        try {
            $permission = $this->permissionRepository->findById($id);

            if (!$permission) {
                return $this->errorResponse('Permission not found.', 404);
            }

            if ($permission->roles()->exists()) {
                return $this->errorResponse('Cannot delete permission as it is assigned to one or more roles.', 403);
            }

            $this->executeTransaction(function () use ($id) {
                $this->permissionRepository->delete($id);
            });

            return $this->successResponse(null, 'Permission deleted successfully.');
        } catch (\Exception $e) {
            $this->logError('Failed to delete permission ID ' . $id . ': ' . $e->getMessage());

            return $this->errorResponse('Failed to delete permission. Please try again.', 500);
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

        return $permissions->groupBy(function ($permission) {
            return $permission->group ?? 'Ungrouped';
        })->toArray();
    }

    /**
     * Get valid permission IDs from an array.
     *
     * @param array $permissionIds
     * @return array
     */
    public function getValidPermissionIds(array $permissionIds): array
    {
        if (empty($permissionIds)) {
            return [];
        }

        return $this->permissionRepository->getAll()
            ->whereIn('id', $permissionIds)
            ->pluck('id')
            ->toArray();
    }

    /**
     * Assign permissions to a role.
     *
     * @param int $roleId
     * @param array $permissionIds
     * @return mixed
     */
    public function assignPermissionsToRole(int $roleId, array $permissionIds): mixed
    {
        try {
            $role = $this->roleRepository->findById($roleId);

            if (!$role) {
                return $this->errorResponse('Role not found.', 404);
            }

            $this->executeTransaction(function () use ($roleId, $permissionIds) {
                $this->roleRepository->syncPermissions($roleId, $permissionIds);
            });

            $role->load('permissions');

            return $this->successResponse($role, 'Permissions assigned to role successfully.');
        } catch (\Exception $e) {
            $this->logError('Failed to assign permissions to role ID ' . $roleId . ': ' . $e->getMessage(), ['permissionIds' => $permissionIds]);

            return $this->errorResponse('Failed to assign permissions. Please try again.', 500);
        }
    }
}