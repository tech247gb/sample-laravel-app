<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create permissions
        $permissions = [
            'view',
            'edit posts',
            'delete posts',
            'approve comments',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo($permissions);

        $editorRole = Role::create(['name' => 'editor']);
        $editorRole->givePermissionTo(['view', 'edit posts', 'delete posts']);

        $authorRole = Role::create(['name' => 'author']);
        $authorRole->givePermissionTo(['view']);

        $viewerRole = Role::create(['name' => 'viewer']);
    }
}
