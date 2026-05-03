<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'create article',
            'edit article',
            'delete article',
            'submit article',
            'approve article',
            'reject article',
            'publish article'
        ];

        // Create permissions
        foreach ($permissions as $perm) {
            Permission::firstOrCreate([
                'name' => $perm,
                'guard_name' => 'web'
            ]);
        }

        // Create roles
        $admin = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        $editor = Role::firstOrCreate([
            'name' => 'editor',
            'guard_name' => 'web'
        ]);

        $journalist = Role::firstOrCreate([
            'name' => 'journalist',
            'guard_name' => 'web'
        ]);

        // Assign permissions
        $admin->syncPermissions(Permission::all());

        $editor->syncPermissions([
            'approve article',
            'reject article',
            'publish article'
        ]);

        $journalist->syncPermissions([
            'create article',
            'submit article'
        ]);
    }
}