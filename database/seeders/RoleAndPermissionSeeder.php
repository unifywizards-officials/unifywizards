<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate in correct order (child tables first)
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('roles')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // =====================
        // Permissions
        // =====================

        // Dashboard
        $dashboardView = Permission::create(['name' => 'view dashboard', 'group' => 'Dashboard', 'description' => 'Can view admin dashboard']);

        // User Management
        $usersView = Permission::create(['name' => 'view users', 'group' => 'Users', 'description' => 'Can view users list']);
        $usersCreate = Permission::create(['name' => 'create users', 'group' => 'Users', 'description' => 'Can create new users']);
        $usersEdit = Permission::create(['name' => 'edit users', 'group' => 'Users', 'description' => 'Can edit existing users']);
        $usersDelete = Permission::create(['name' => 'delete users', 'group' => 'Users', 'description' => 'Can delete users']);
        $usersAssignRoles = Permission::create(['name' => 'assign roles to users', 'group' => 'Users', 'description' => 'Can assign roles to users']);

        // Role Management
        $rolesView = Permission::create(['name' => 'view roles', 'group' => 'Roles', 'description' => 'Can view roles list']);
        $rolesCreate = Permission::create(['name' => 'create roles', 'group' => 'Roles', 'description' => 'Can create new roles']);
        $rolesEdit = Permission::create(['name' => 'edit roles', 'group' => 'Roles', 'description' => 'Can edit existing roles']);
        $rolesDelete = Permission::create(['name' => 'delete roles', 'group' => 'Roles', 'description' => 'Can delete roles']);

        // Permission Management
        $permissionsView = Permission::create(['name' => 'view permissions', 'group' => 'Permissions', 'description' => 'Can view permissions list']);
        $permissionsCreate = Permission::create(['name' => 'create permissions', 'group' => 'Permissions', 'description' => 'Can create new permissions']);
        $permissionsEdit = Permission::create(['name' => 'edit permissions', 'group' => 'Permissions', 'description' => 'Can edit existing permissions']);
        $permissionsDelete = Permission::create(['name' => 'delete permissions', 'group' => 'Permissions', 'description' => 'Can delete permissions']);

        // Profile
        $profileView = Permission::create(['name' => 'view profile', 'group' => 'Profile', 'description' => 'Can view own profile']);
        $profileEdit = Permission::create(['name' => 'edit profile', 'group' => 'Profile', 'description' => 'Can edit own profile']);

        // Categories
        $categoriesView = Permission::create(['name' => 'view categories', 'group' => 'Categories', 'description' => 'Can view categories list']);
        $categoriesCreate = Permission::create(['name' => 'create categories', 'group' => 'Categories', 'description' => 'Can create new categories']);
        $categoriesEdit = Permission::create(['name' => 'edit categories', 'group' => 'Categories', 'description' => 'Can edit existing categories']);
        $categoriesDelete = Permission::create(['name' => 'delete categories', 'group' => 'Categories', 'description' => 'Can delete categories']);

        // Sub Categories
        $subCategoriesView = Permission::create(['name' => 'view sub-categories', 'group' => 'Sub Categories', 'description' => 'Can view sub-categories list']);
        $subCategoriesCreate = Permission::create(['name' => 'create sub-categories', 'group' => 'Sub Categories', 'description' => 'Can create new sub-categories']);
        $subCategoriesEdit = Permission::create(['name' => 'edit sub-categories', 'group' => 'Sub Categories', 'description' => 'Can edit existing sub-categories']);
        $subCategoriesDelete = Permission::create(['name' => 'delete sub-categories', 'group' => 'Sub Categories', 'description' => 'Can delete sub-categories']);

        // Change Password
        $passwordChange = Permission::create(['name' => 'change password', 'group' => 'Security', 'description' => 'Can change own password']);

        // Other content-management sections (single permission per section)
        $blogs = Permission::create(['name' => 'blogs', 'group' => 'Content', 'description' => 'Can manage blog posts']);
        $settings = Permission::create(['name' => 'settings', 'group' => 'Content', 'description' => 'Can manage site settings']);
        $media = Permission::create(['name' => 'media', 'group' => 'Content', 'description' => 'Can manage media library']);
        $seo = Permission::create(['name' => 'seo', 'group' => 'Content', 'description' => 'Can manage SEO settings']);
        $aboutPage = Permission::create(['name' => 'about-page', 'group' => 'Content', 'description' => 'Can manage the About Us page']);
        $homePage = Permission::create(['name' => 'home-page', 'group' => 'Content', 'description' => 'Can manage Home page sections']);
        $schema = Permission::create(['name' => 'schema', 'group' => 'Content', 'description' => 'Can manage schema markup']);
        $designBranding = Permission::create(['name' => 'design-branding', 'group' => 'Content', 'description' => 'Can manage design & branding']);
        $digitalMarketing = Permission::create(['name' => 'digital-marketing', 'group' => 'Content', 'description' => 'Can manage digital marketing pages']);
        $outstandingResults = Permission::create(['name' => 'outstanding-results', 'group' => 'Content', 'description' => 'Can manage outstanding results']);
        $clientRecommendations = Permission::create(['name' => 'client-recommendations', 'group' => 'Content', 'description' => 'Can manage client recommendations']);
        $recentAwards = Permission::create(['name' => 'recent-awards', 'group' => 'Content', 'description' => 'Can manage recent awards']);
        $reviewScreenshots = Permission::create(['name' => 'review-screenshots', 'group' => 'Content', 'description' => 'Can manage review screenshots']);
        $businessChooseUs = Permission::create(['name' => 'business-choose-us', 'group' => 'Content', 'description' => 'Can manage the business choose-us section']);
        $extraFolds = Permission::create(['name' => 'extra-folds', 'group' => 'Content', 'description' => 'Can manage extra fold sections']);
        $sitePages = Permission::create(['name' => 'site-pages', 'group' => 'Content', 'description' => 'Can manage terms & privacy pages']);
        $pages = Permission::create(['name' => 'pages', 'group' => 'Content', 'description' => 'Can manage generic content pages']);
        $loginHistory = Permission::create(['name' => 'view login history', 'group' => 'Security', 'description' => 'Can view login/logout history']);

        // =====================
        // Super Admin Role (ID: 1)
        // =====================
        $superAdmin = Role::create([
            'name' => 'super-admin',
            'description' => 'Full system access with all permissions',
            'is_super_admin' => true,
        ]);

        // Assign ALL permissions to super admin
        $allPermissions = Permission::all()->pluck('id')->toArray();
        $superAdmin->permissions()->sync($allPermissions);

        // =====================
        // Admin Role
        // =====================
        $adminRole = Role::create([
            'name' => 'admin',
            'description' => 'Administrator with full content management access',
            'is_super_admin' => false,
        ]);

        $adminPermissions = [
            $dashboardView->id,
            $usersView->id, $usersCreate->id, $usersEdit->id, $usersDelete->id, $usersAssignRoles->id,
            $rolesView->id, $rolesCreate->id, $rolesEdit->id, $rolesDelete->id,
            $permissionsView->id, $permissionsCreate->id, $permissionsEdit->id, $permissionsDelete->id,
            $profileView->id, $profileEdit->id,
            $categoriesView->id, $categoriesCreate->id, $categoriesEdit->id, $categoriesDelete->id,
            $subCategoriesView->id, $subCategoriesCreate->id, $subCategoriesEdit->id, $subCategoriesDelete->id,
            $passwordChange->id,
            $blogs->id, $settings->id, $media->id, $seo->id, $aboutPage->id, $homePage->id,
            $schema->id, $designBranding->id, $digitalMarketing->id, $outstandingResults->id,
            $clientRecommendations->id, $recentAwards->id, $reviewScreenshots->id,
            $businessChooseUs->id, $extraFolds->id, $sitePages->id, $pages->id,
            $loginHistory->id,
        ];
        $adminRole->permissions()->sync($adminPermissions);

        // =====================
        // Editor Role
        // =====================
        $editorRole = Role::create([
            'name' => 'editor',
            'description' => 'Content editor with limited management access',
            'is_super_admin' => false,
        ]);

        $editorPermissions = [
            $dashboardView->id,
            $categoriesView->id, $categoriesCreate->id, $categoriesEdit->id,
            $subCategoriesView->id, $subCategoriesCreate->id, $subCategoriesEdit->id,
            $profileView->id, $profileEdit->id,
            $passwordChange->id,
        ];
        $editorRole->permissions()->sync($editorPermissions);

        // =====================
        // Viewer Role
        // =====================
        $viewerRole = Role::create([
            'name' => 'viewer',
            'description' => 'Read-only access',
            'is_super_admin' => false,
        ]);

        $viewerPermissions = [
            $dashboardView->id,
            $categoriesView->id,
            $subCategoriesView->id,
            $profileView->id,
        ];
        $viewerRole->permissions()->sync($viewerPermissions);

        $this->command->info('Roles & Permissions seeded successfully!');
    }
}