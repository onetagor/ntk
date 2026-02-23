<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        $permissions = [
            // Dashboard
            'dashboard.view',
            
            // User Management
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',
            
            // Admin Management
            'admins.view',
            'admins.create',
            'admins.edit',
            'admins.delete',
            
            // Role & Permission Management
            'roles.view',
            'roles.create',
            'roles.edit',
            'roles.delete',
            'permissions.view',
            'permissions.create',
            'permissions.edit',
            'permissions.delete',
            
            // CMS - Site Settings
            'site-settings.view',
            'site-settings.edit',
            
            // CMS - Sliders
            'sliders.view',
            'sliders.create',
            'sliders.edit',
            'sliders.delete',
            
            // CMS - Services
            'services.view',
            'services.create',
            'services.edit',
            'services.delete',
            
            // CMS - Packages
            'packages.view',
            'packages.create',
            'packages.edit',
            'packages.delete',
            
            // CMS - Statistics
            'statistics.view',
            'statistics.create',
            'statistics.edit',
            'statistics.delete',
            
            // CMS - Blogs
            'blogs.view',
            'blogs.create',
            'blogs.edit',
            'blogs.delete',
            
            // CMS - Testimonials
            'testimonials.view',
            'testimonials.create',
            'testimonials.edit',
            'testimonials.delete',
            
            // CMS - Newsletters
            'newsletters.view',
            'newsletters.delete',
            'newsletters.export',
            
            // Orders Management
            'orders.view',
            'orders.create',
            'orders.edit',
            'orders.delete',
            'orders.update-status',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission],
                ['guard_name' => 'admin']
            );
        }

        // Create Roles and Assign Permissions
        
        // 1. Super Admin Role (Full Access)
        $superAdminRole = Role::firstOrCreate(
            ['name' => 'SuperAdmin'],
            ['guard_name' => 'admin']
        );
        $superAdminRole->syncPermissions(Permission::all());

        // 2. Admin Role (Most Access except role/permission management)
        $adminRole = Role::firstOrCreate(
            ['name' => 'Admin'],
            ['guard_name' => 'admin']
        );
        $adminPermissions = Permission::whereNotIn('name', [
            'roles.create', 'roles.edit', 'roles.delete',
            'permissions.create', 'permissions.edit', 'permissions.delete',
            'admins.delete'
        ])->get();
        $adminRole->syncPermissions($adminPermissions);

        // 3. Editor Role (CMS Content Management only)
        $editorRole = Role::firstOrCreate(
            ['name' => 'Editor'],
            ['guard_name' => 'admin']
        );
        $editorPermissions = Permission::where('name', 'like', 'sliders%')
            ->orWhere('name', 'like', 'services%')
            ->orWhere('name', 'like', 'packages%')
            ->orWhere('name', 'like', 'statistics%')
            ->orWhere('name', 'like', 'blogs%')
            ->orWhere('name', 'like', 'testimonials%')
            ->orWhere('name', 'like', 'newsletters%')
            ->orWhere('name', 'like', 'site-settings%')
            ->orWhere('name', 'dashboard.view')
            ->get();
        $editorRole->syncPermissions($editorPermissions);

        // 4. Viewer Role (Read Only)
        $viewerRole = Role::firstOrCreate(
            ['name' => 'Viewer'],
            ['guard_name' => 'admin']
        );
        $viewerPermissions = Permission::where('name', 'like', '%.view')->get();
        $viewerRole->syncPermissions($viewerPermissions);

        // Create Default Admin Users
        
        // 1. Super Admin User
        $superAdmin = Admin::firstOrCreate(
            ['email' => 'superadmin@admin.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'phone' => '01700000000',
                'status' => 1,
            ]
        );
        $superAdmin->assignRole('SuperAdmin');

        // 2. Regular Admin User
        $admin = Admin::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'phone' => '01700000001',
                'status' => 1,
            ]
        );
        $admin->assignRole('Admin');

        // 3. Editor User
        $editor = Admin::firstOrCreate(
            ['email' => 'editor@admin.com'],
            [
                'name' => 'Editor',
                'password' => Hash::make('password'),
                'phone' => '01700000002',
                'status' => 1,
            ]
        );
        $editor->assignRole('Editor');

        $this->command->info('✅ Admin users created successfully!');
        $this->command->info('');
        $this->command->info('📧 Super Admin Login Credentials:');
        $this->command->info('   Email: superadmin@admin.com');
        $this->command->info('   Password: password');
        $this->command->info('');
        $this->command->info('📧 Admin Login Credentials:');
        $this->command->info('   Email: admin@admin.com');
        $this->command->info('   Password: password');
        $this->command->info('');
        $this->command->info('📧 Editor Login Credentials:');
        $this->command->info('   Email: editor@admin.com');
        $this->command->info('   Password: password');
    }
}
