<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Create Permissions
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);

        // 3. Create Roles and Assign Permissions
        $roleWriter = Role::create(['name' => 'writer']);
        $roleWriter->givePermissionTo('edit articles');

        $roleAdmin = Role::create(['name' => 'admin']);
        $roleAdmin->givePermissionTo(Permission::all());

        // 4. Create Demo Users and Assign Roles
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);
        $admin->assignRole($roleAdmin);

        $writer = User::factory()->create([
            'name' => 'Writer User',
            'email' => 'writer@example.com',
        ]);
        $writer->assignRole($roleWriter);
    }
}