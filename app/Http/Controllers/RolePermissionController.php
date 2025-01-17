<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:mengelola role')->only(['indexRole', 'createRole', 'editRole', 'deleteRole']);
        $this->middleware('permission:mengelola permission')->only(['indexPermission', 'assignPermissions']);
    }

    public function indexRole()
    {
        $roles = Role::all();
        return view('users.roles.index', compact('roles'));
    }

    public function indexPermission()
    {
        // $roles = Role::with('permissions')->get();
        // $permissions = Permission::all();

        $roles = Role::all();
        $permissions = Permission::all();

        // Tambahkan ini untuk menyimpan permission yang sudah ter-assign
        $rolePermissions = [];
        
        foreach($roles as $role) {
            $rolePermissions[$role->id] = $role->permissions->pluck('name')->toArray();
        }
        return view('users.permissions.index', compact('roles', 'permissions', 'rolePermissions'));
    }

    public function createRole(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        Role::create(['name' => $validatedData['name']]);
        return back()->with('success', 'Role baru berhasil dibuat');
    }

    public function editRole(Request $request)
    {
        $validatedData = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|unique:roles,name,' . $request->role_id
        ]);

        $role = Role::findById($request->role_id);
        $role->update(['name' => $validatedData['name']]);

        return back()->with('success', 'Role berhasil diperbarui');
    }

    public function deleteRole(Role $role)
    {
        if (in_array($role->name, ['admin', 'guru', 'siswa'])) {
            return back()->with('error', 'Role default tidak dapat dihapus');
        }
        
        $role->delete();
        return back()->with('success', 'Role berhasil dihapus');
    }

    public function assignPermissions(Request $request)
    {
        $role = Role::findById($request->role_id);
        $role->syncPermissions($request->permissions);

        return back()->with('success', 'Permission berhasil diperbarui');
    }
}