<?php

namespace App\Repositories;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PermissionRepository
{
    /**
     * @var Permission
     */
    protected Permission $model;

    /**
     * PermissionRepository constructor.
     */
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    /**
     * Get all permissions with pagination.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model
            ->withCount('roles')
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Get all permissions without pagination.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model
            ->orderBy('group')
            ->orderBy('name')
            ->get();
    }

    /**
     * Get permissions grouped by their group name.
     *
     * @return Collection
     */
    public function getGrouped(): Collection
    {
        return $this->model
            ->orderBy('group')
            ->orderBy('name')
            ->get()
            ->groupBy('group');
    }

    /**
     * Get all permission groups.
     *
     * @return array
     */
    public function getGroups(): array
    {
        return $this->model
            ->select('group')
            ->whereNotNull('group')
            ->distinct()
            ->orderBy('group')
            ->pluck('group')
            ->toArray();
    }

    /**
     * Find a permission by ID.
     *
     * @param int $id
     * @return Permission|null
     */
    public function findById(int $id): ?Permission
    {
        return $this->model->with('roles')->find($id);
    }

    /**
     * Find a permission by name.
     *
     * @param string $name
     * @return Permission|null
     */
    public function findByName(string $name): ?Permission
    {
        return $this->model->where('name', $name)->first();
    }

    /**
     * Create a new permission.
     *
     * @param array $data
     * @return Permission
     */
    public function create(array $data): Permission
    {
        return $this->model->create($data);
    }

    /**
     * Update an existing permission.
     *
     * @param int $id
     * @param array $data
     * @return Permission
     */
    public function update(int $id, array $data): Permission
    {
        $permission = $this->findById($id);
        $permission->update($data);

        return $permission->fresh();
    }

    /**
     * Delete a permission.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $permission = $this->findById($id);

        if ($permission && $permission->roles()->exists()) {
            return false;
        }

        return (bool) $this->model->destroy($id);
    }

    /**
     * Get permissions that are not assigned to a specific role.
     *
     * @param int $roleId
     * @return Collection
     */
    public function getPermissionsNotAssignedToRole(int $roleId): Collection
    {
        return $this->model
            ->whereDoesntHave('roles', function ($query) use ($roleId) {
                $query->where('roles.id', $roleId);
            })
            ->get();
    }
}