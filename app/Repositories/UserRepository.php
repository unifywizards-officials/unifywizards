<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository
{
    /**
     * @var User
     */
    protected User $model;

    /**
     * UserRepository constructor.
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Get all users with pagination.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model
            ->with('roles')
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Get all users without pagination.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model
            ->with('roles')
            ->orderBy('name')
            ->get();
    }

    /**
     * Find a user by ID.
     *
     * @param int $id
     * @return User|null
     */
    public function findById(int $id): ?User
    {
        return $this->model->with('roles')->find($id);
    }

    /**
     * Update user's role directly on the users table.
     *
     * @param int $userId
     * @param int $roleId
     * @return User
     */
    public function updateRoleId(int $userId, int $roleId): ?User
    {
        $user = $this->model->find($userId);
        if (!$user) {
            return null;
        }
        $user->role_id = $roleId;
        $user->save();

        return $user;
    }

    /**
     * Update user roles.
     *
     * @param int $userId
     * @param array $roleIds
     * @return User
     */
    public function syncRoles(int $userId, array $roleIds): ?User
    {
        $user = $this->findById($userId);
        if (!$user) {
            return null;
        }
        $user->roles()->sync($roleIds);

        return $user->fresh('roles');
    }
}