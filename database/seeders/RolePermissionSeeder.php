<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $authorities = config('permission.authorities');

        $listPermission = [];
        $superAdminPermission = [];
        $adminPermission = [];
        $editorPermission = [];

        foreach ($authorities as $label => $permissions) {
            foreach ($permissions as $permission) {
                $listPermission[] = [
                    'name' => $permission,
                    'guard_name' => 'web',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                // Super Admin
                $superAdminPermission[] = $permission;
                // Admin
                if (in_array($label, ['Manage Posts', 'Manage Categories'])) {
                    $adminPermission[] = $permission;
                }
                // Editor
                if (in_array($label, ['Manage Posts'])) {
                    $editorPermission[] = $permission;
                }
            }
        }

        // Insert  Permissions
        Permission::insert($listPermission);

        // Inser Roles
        // Super Admin
        $superAdmin = Role::create(
            [
                'name' => "Super Admin",
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        // Admin
        $admin = Role::create(
            [
                'name' => "Admin",
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        // Editor
        $editor = Role::create(
            [
                'name' => "Editor",
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        // Role -> Permission
        $superAdmin->givePermissionTo($superAdminPermission);
        $admin->givePermissionTo($adminPermission);
        $editor->givePermissionTo($editorPermission);

        //
        $superAdmin = User::find(1)->assignRole("Super Admin");
    }
}
