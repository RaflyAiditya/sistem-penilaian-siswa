<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        return view('roles-permissions.index', compact('roles', 'permissions'));
    }

    public function createRole(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        Role::create(['name' => $validatedData['name']]);
        return back()->with('success', 'Role created successfully');
    }

    public function assignPermissions(Request $request)
    {
        $role = Role::findById($request->role_id);
        $role->syncPermissions($request->permissions);

        return back()->with('success', 'Permissions assigned successfully');
    }
}