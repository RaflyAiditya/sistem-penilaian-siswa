<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'add-user']);
        Permission::create(['name' => 'view-user']);
        Permission::create(['name' => 'edit-user']);
        Permission::create(['name' => 'delete-user']);

        Permission::create(['name' => 'add-grade']);
        Permission::create(['name' => 'view-grade']);
        Permission::create(['name' => 'edit-grade']);
        Permission::create(['name' => 'delete-grade']);

        Permission::create(['name' => 'add-student']);
        Permission::create(['name' => 'view-student']);
        Permission::create(['name' => 'edit-student']);
        Permission::create(['name' => 'delete-student']);

        Permission::create(['name' => 'add-subject']);
        Permission::create(['name' => 'view-subject']);
        Permission::create(['name' => 'edit-subject']);
        Permission::create(['name' => 'delete-subject']);

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'guru']);

        $roleAdmin = Role::findByName('admin');
        $roleAdmin -> givePermissionTo(Permission::all());

        $roleAdmin = Role::findByName('guru');
        $roleAdmin -> givePermissionTo('add-grade');
        $roleAdmin -> givePermissionTo('view-grade');
        $roleAdmin -> givePermissionTo('edit-grade');
        $roleAdmin -> givePermissionTo('delete-grade');
        
    }
}
