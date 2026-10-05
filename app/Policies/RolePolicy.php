<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any roles.
     */
    public function viewAny(User $user): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        return $user->can('view roles');
    }

    /**
     * Determine whether the user can view a role.
     */
    public function view(User $user, Role $role): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        return $user->can('view roles');
    }

    /**
     * Determine whether the user can create roles.
     */
    public function create(User $user): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        return $user->can('create roles');
    }

    /**
     * Determine whether the user can update a role.
     */
    public function update(User $user, Role $role): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        // Prevent editing super admin role
        if ($role->is_super_admin) {
            return false;
        }

        return $user->can('edit roles');
    }

    /**
     * Determine whether the user can delete a role.
     */
    public function delete(User $user, Role $role): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        // Prevent deleting super admin role
        if ($role->is_super_admin) {
            return false;
        }

        return $user->can('delete roles');
    }
}