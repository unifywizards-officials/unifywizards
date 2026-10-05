<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any permissions.
     */
    public function viewAny(User $user): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        return $user->can('view permissions');
    }

    /**
     * Determine whether the user can view a permission.
     */
    public function view(User $user, Permission $permission): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        return $user->can('view permissions');
    }

    /**
     * Determine whether the user can create permissions.
     */
    public function create(User $user): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        return $user->can('create permissions');
    }

    /**
     * Determine whether the user can update a permission.
     */
    public function update(User $user, Permission $permission): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        return $user->can('edit permissions');
    }

    /**
     * Determine whether the user can delete a permission.
     */
    public function delete(User $user, Permission $permission): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        return $user->can('delete permissions');
    }
}