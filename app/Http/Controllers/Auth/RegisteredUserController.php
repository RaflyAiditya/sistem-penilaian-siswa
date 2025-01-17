<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nip_or_nis' => ['required', 'numeric', 'digits_between:1,18', 'unique:' . User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Cek apakah NIP/NIS ada di tabel teachers atau students
        $isTeacher = Teacher::where('nip', $request->nip_or_nis)->exists();
        $isStudent = Student::where('nis', $request->nip_or_nis)->exists();

        if (!$isTeacher && !$isStudent) {
            throw ValidationException::withMessages([
                'nip_or_nis' => ['NIP/NIS tidak ditemukan dalam database.'],
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'nip_or_nis' => $request->nip_or_nis,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign role berdasarkan NIP/NIS
        if ($isTeacher) {
            $user->assignRole('guru');
        } else {
            $user->assignRole('siswa');
        }


        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
