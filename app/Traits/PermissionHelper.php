<?php

namespace App\Traits;

use Illuminate\Http\Request;

/**
 * Trait PermissionHelper
 *
 * Provides helper methods for permission and role checks.
 */
trait PermissionHelper
{
    /**
     * Check if the current user has a specific permission.
     *
     * @param string $permission
     * @return bool
     */
    protected function userHasPermission(string $permission): bool
    {
        $user = auth()->user();

        if (!$user) {
            return false;
        }

        // Super admin bypass
        if (method_exists($user, 'isSuperAdmin') && $user->isSuperAdmin()) {
            return true;
        }

        return $user->can($permission);
    }

    /**
     * Check if the current user has any of the given permissions.
     *
     * @param array $permissions
     * @return bool
     */
    protected function userHasAnyPermission(array $permissions): bool
    {
        $user = auth()->user();

        if (!$user) {
            return false;
        }

        // Super admin bypass
        if (method_exists($user, 'isSuperAdmin') && $user->isSuperAdmin()) {
            return true;
        }

        return $user->hasAnyPermission($permissions);
    }

    /**
     * Get all available permission groups.
     *
     * @return array
     */
    protected function getPermissionGroups(): array
    {
        return \App\Models\Permission::select('group')
            ->whereNotNull('group')
            ->distinct()
            ->pluck('group')
            ->toArray();
    }

    /**
     * Validate incoming permission data.
     *
     * @param Request $request
     * @return array
     */
    protected function validatePermissions(Request $request): array
    {
        $permissions = $request->input('permissions', []);

        if (!is_array($permissions)) {
            return [];
        }

        return array_filter($permissions, function ($permission) {
            return is_string($permission) && !empty(trim($permission));
        });
    }
}