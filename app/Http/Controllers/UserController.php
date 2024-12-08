<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //
    public function index()
    {
        // $users = User::all();
        $users = User::with('roles')->get();
        return view('users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all(); // Ambil semua role
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'roles' => 'required|array',
        ]);

        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        // Pastikan menggunakan nama role untuk sinkronisasi
        $user->syncRoles($validatedData['roles']);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

}