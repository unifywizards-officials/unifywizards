<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;
use App\Traits\HasTransaction;
use App\Traits\HasLogger;
use App\Traits\HasResponse;

class UserService
{
    use HasTransaction, HasLogger, HasResponse;

    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    /**
     * @var RoleRepository
     */
    protected RoleRepository $roleRepository;

    /**
     * UserService constructor.
     */
    public function __construct(
        UserRepository $userRepository,
        RoleRepository $roleRepository
    ) {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Get all users with pagination.
     *
     * @param int $perPage
     * @return mixed
     */
    public function getAllUsers(int $perPage = 15): mixed
    {
        return $this->userRepository->getAllPaginated($perPage);
    }

    /**
     * Get a user by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getUserById(int $id): mixed
    {
        $user = $this->userRepository->findById($id);

        if (!$user) {
            return $this->errorResponse('User not found.', 404);
        }

        return $this->successResponse($user, 'User retrieved successfully.');
    }

    /**
     * Assign roles to a user.
     *
     * @param int $userId
     * @param array $roleIds
     * @return mixed
     */
    public function assignRoles(int $userId, array $roleIds): mixed
    {
        try {
            $user = $this->userRepository->findById($userId);

            if (!$user) {
                return $this->errorResponse('User not found.', 404);
            }

            // Prevent removing all roles from a super admin user
            if ($user->isSuperAdmin() && empty($roleIds)) {
                return $this->errorResponse('Cannot remove all roles from a super admin user.', 403);
            }

            $this->executeTransaction(function () use ($userId, $roleIds) {
                $this->userRepository->syncRoles($userId, $roleIds);
            });

            $user->load('roles');

            return $this->successResponse($user, 'Roles assigned to user successfully.');
        } catch (\Exception $e) {
            $this->logError('Failed to assign roles to user ID ' . $userId . ': ' . $e->getMessage(), ['roleIds' => $roleIds]);

            return $this->errorResponse('Failed to assign roles. Please try again.', 500);
        }
    }

    /**
     * Update a user's role (single role assignment).
     * Saves role_id on users table AND syncs pivot table.
     *
     * @param int $userId
     * @param int $roleId
     * @return mixed
     */
    public function updateRole(int $userId, int $roleId): mixed
    {
        try {
            // Find the user fresh from DB
            $user = \DB::table('users')->where('id', $userId)->first();

            if (!$user) {
                return $this->errorResponse('User not found.', 404);
            }

            // Find the role by ID
            $role = $this->roleRepository->findById($roleId);

            if (!$role) {
                return $this->errorResponse('Role not found.', 404);
            }

            // Get current role from pivot table
            $currentRoleId = \DB::table('model_has_roles')
                ->where('model_id', $userId)
                ->where('model_type', User::class)
                ->value('role_id');

            // Check if user already has this exact role - return success without changes
            if ($currentRoleId == $roleId) {
                $userModel = User::with('roles')->find($userId);
                return $this->successResponse($userModel, 'Role already assigned.');
            }

            $this->executeTransaction(function () use ($userId, $roleId) {
                \DB::table('users')
                    ->where('id', $userId)
                    ->update(['role_id' => $roleId]);

                // Update pivot table - delete existing and insert new
                \DB::table('model_has_roles')
                    ->where('model_id', $userId)
                    ->where('model_type', User::class)
                    ->delete();

                \DB::table('model_has_roles')->insert([
                    'role_id' => $roleId,
                    'model_type' => User::class,
                    'model_id' => $userId,
                ]);
            });

            $userModel = User::with('roles')->find($userId);

            return $this->successResponse($userModel, 'User role updated successfully.');
        } catch (\Exception $e) {
            $this->logError('Failed to update role for user ID ' . $userId . ': ' . $e->getMessage(), ['roleId' => $roleId]);

            return $this->errorResponse('Failed to update role. Please try again.', 500);
        }
    }
}