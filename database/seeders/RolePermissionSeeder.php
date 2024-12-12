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

        Permission::create(['name' => 'melihat pengguna']);
        Permission::create(['name' => 'mengelola pengguna']);

        Permission::create(['name' => 'mengelola roles dan permissions']);

        Permission::create(['name' => 'melihat nilai']);
        Permission::create(['name' => 'mengelola nilai']);

        Permission::create(['name' => 'melihat siswa']);
        Permission::create(['name' => 'mengelola siswa']);

        Permission::create(['name' => 'melihat daftar pelajaran']);
        Permission::create(['name' => 'mengelola daftar pelajaran']);

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'guru']);
        Role::create(['name' => 'user']);

        $roleAdmin = Role::findByName('admin');
        $roleAdmin->givePermissionTo(Permission::all());

        $roleGuru = Role::findByName('guru');
        $roleGuru->givePermissionTo('melihat nilai');
        $roleGuru->givePermissionTo('mengelola nilai');
        $roleGuru->givePermissionTo('melihat siswa');
        $roleGuru->givePermissionTo('melihat daftar pelajaran');

        $roleUser = Role::findByName('user');
        $roleUser->givePermissionTo('melihat nilai');
        $roleUser->givePermissionTo('melihat siswa');
        $roleUser->givePermissionTo('melihat daftar pelajaran');
    }
}
