<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'roles' => 'required|array',
            'password' => 'nullable|min:8|confirmed',
        ];
    
        $messages = [
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ];
    
        $validatedData = $request->validate($rules, $messages);
    
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);
        
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
            $user->save();
        }

        $user->syncRoles($validatedData['roles']);

        return redirect()->route('users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function verifyPassword(Request $request)
    {
        if (Hash::check($request->password, auth()->user()->password)) {
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false], 422);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Cek jika pengguna yang dihapus adalah admin utama (opsional)
        // if ($user->hasRole('admin')) {
        //     return redirect()->route('users.index')->with('error', 'Admin utama tidak dapat dihapus.');
        // }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}