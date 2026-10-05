<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class RoleRepository
{
    /**
     * @var Role
     */
    protected Role $model;

    /**
     * RoleRepository constructor.
     */
    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    /**
     * Get all roles with pagination.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model
            ->withCount('permissions')
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Get all roles without pagination.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model
            ->with('permissions')
            ->orderBy('name')
            ->get();
    }

    /**
     * Get super admin roles.
     *
     * @return Collection
     */
    public function getSuperAdminRoles(): Collection
    {
        return $this->model->superAdmin()->get();
    }

    /**
     * Find a role by ID.
     *
     * @param int $id
     * @return Role|null
     */
    public function findById(int $id): ?Role
    {
        return $this->model->with('permissions')->find($id);
    }

    /**
     * Find a role by name.
     *
     * @param string $name
     * @return Role|null
     */
    public function findByName(string $name): ?Role
    {
        return $this->model->where('name', $name)->first();
    }

    /**
     * Create a new role.
     *
     * @param array $data
     * @return Role
     */
    public function create(array $data): Role
    {
        return $this->model->create($data);
    }

    /**
     * Update an existing role.
     *
     * @param int $id
     * @param array $data
     * @return Role
     */
    public function update(int $id, array $data): Role
    {
        $role = $this->findById($id);
        $role->update($data);

        return $role->fresh();
    }

    /**
     * Delete a role.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $role = $this->findById($id);

        if ($role && $role->is_super_admin) {
            return false;
        }

        return (bool) $this->model->destroy($id);
    }

    /**
     * Sync permissions for a role.
     *
     * @param int $roleId
     * @param array $permissionIds
     * @return void
     */
    public function syncPermissions(int $roleId, array $permissionIds): void
    {
        $role = $this->findById($roleId);
        $role->permissions()->sync($permissionIds);
    }

    /**
     * Get roles that do not have a specific permission.
     *
     * @param string $permissionName
     * @return Collection
     */
    public function getRolesWithoutPermission(string $permissionName): Collection
    {
        return $this->model
            ->whereDoesntHave('permissions', function ($query) use ($permissionName) {
                $query->where('name', $permissionName);
            })
            ->get();
    }

    /**
     * Check if a role has a specific permission.
     *
     * @param int $roleId
     * @param string $permissionName
     * @return bool
     */
    public function roleHasPermission(int $roleId, string $permissionName): bool
    {
        $role = $this->findById($roleId);

        return $role ? $role->hasPermissionTo($permissionName) : false;
    }
}