<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

/**
 * Safe to run on an already-seeded/production database: unlike
 * RoleAndPermissionSeeder (which truncates everything), this only
 * ever creates permissions that don't already exist and *adds* them
 * to the admin role without touching any existing role/permission
 * assignment.
 *
 * php artisan db:seed --class=AdditionalContentPermissionsSeeder
 */
class AdditionalContentPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['name' => 'blogs', 'group' => 'Content', 'description' => 'Can manage blog posts'],
            ['name' => 'settings', 'group' => 'Content', 'description' => 'Can manage site settings'],
            ['name' => 'media', 'group' => 'Content', 'description' => 'Can manage media library'],
            ['name' => 'seo', 'group' => 'Content', 'description' => 'Can manage SEO settings'],
            ['name' => 'about-page', 'group' => 'Content', 'description' => 'Can manage the About Us page'],
            ['name' => 'home-page', 'group' => 'Content', 'description' => 'Can manage Home page sections'],
            ['name' => 'schema', 'group' => 'Content', 'description' => 'Can manage schema markup'],
            ['name' => 'design-branding', 'group' => 'Content', 'description' => 'Can manage design & branding'],
            ['name' => 'digital-marketing', 'group' => 'Content', 'description' => 'Can manage digital marketing pages'],
            ['name' => 'outstanding-results', 'group' => 'Content', 'description' => 'Can manage outstanding results'],
            ['name' => 'client-recommendations', 'group' => 'Content', 'description' => 'Can manage client recommendations'],
            ['name' => 'recent-awards', 'group' => 'Content', 'description' => 'Can manage recent awards'],
            ['name' => 'review-screenshots', 'group' => 'Content', 'description' => 'Can manage review screenshots'],
            ['name' => 'business-choose-us', 'group' => 'Content', 'description' => 'Can manage the business choose-us section'],
            ['name' => 'extra-folds', 'group' => 'Content', 'description' => 'Can manage extra fold sections'],
            ['name' => 'site-pages', 'group' => 'Content', 'description' => 'Can manage terms & privacy pages'],
            ['name' => 'pages', 'group' => 'Content', 'description' => 'Can manage generic content pages'],
            ['name' => 'view login history', 'group' => 'Security', 'description' => 'Can view login/logout history'],
        ];

        $created = [];

        foreach ($permissions as $permission) {
            $created[] = Permission::firstOrCreate(
                ['name' => $permission['name'], 'guard_name' => 'web'],
                ['group' => $permission['group'], 'description' => $permission['description']]
            );
        }

        $adminRole = Role::where('name', 'admin')->first();

        if ($adminRole) {
            // Additive only — never removes permissions the admin role
            // already has, unlike sync().
            $adminRole->givePermissionTo($created);
            $this->command->info('Granted new content permissions to the "admin" role.');
        } else {
            $this->command->warn('No "admin" role found — permissions were created but not assigned to any role. Assign them manually via /admin/roles.');
        }
    }
}
