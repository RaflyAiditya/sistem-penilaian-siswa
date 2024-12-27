<x-navigation-layout title="Edit Akun">

    <x-slot name="header">
        <h1 class="fs-5"><b>Edit Akun</b></h1>

        <x-breadcrumb :items="[
            ['name' => 'Home', 'url' => route('dashboard')],
            ['name' => 'Pengguna', 'url' => null],
            ['name' => 'Atur Akun', 'url' => route('users.index')],
            ['name' => 'Edit', 'url' => null],
        ]" />
    </x-slot>

    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-4 mx-4">
                    <div class="card-body mx-4 mt-2">
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nip_or_nis" class="form-label">NIP atau NIS</label>
                                <input type="text" name="nip_or_nis" id="nip_or_nis" class="form-control" value="{{ old('nip_or_nis', $user->nip_or_nis) }}" required>
                                @error('nip_or_nis')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="roles" class="form-label">Role</label>
                                <select name="roles[]" id="roles" class="form-select" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}" {{ in_array($role->name, $user->roles->pluck('name')->toArray()) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('roles')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password Baru</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Kosongkan jika tidak ingin mengubah password" autocomplete="new-password" onkeyup="checkPassword()" oninput="checkPassword()">
                                    <button class="btn btn-outline-secondary" type="button" style="border: 1px solid #ced4da;" id="togglePassword">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </div>
                                <div id="passwordRequirements" class="form-text" style="display: none; margin-top: 5px;">
                                    <div id="lengthCheck"><i class="fa-solid fa-circle" style="padding-top: 0rem; margin-right: 0.1rem; font-size: 0.85em;"></i> Minimal 8 karakter</div>
                                </div>                  
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <div class="input-group">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" onkeyup="checkPasswordMatch()" oninput="checkPassword()">
                                    <button class="btn btn-outline-secondary" type="button" style="border: 1px solid #ced4da;" id="togglePasswordConfirmation">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </div>
                                <div id="passwordMatchMessage" class="form-text" style="display: none; margin-top: 5px; font-size: 0.875em;"></div>                
                                @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex mt-4 justify-content-start gap-2">
                                <button type="submit" class="btn btn-success" id="submitBtn"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Simpan</button>
                                <a href="{{ route('users.index') }}" class="btn btn-secondary"><i class="fa-solid fa-ban"></i>&nbsp;Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/password.js') }}"></script>
</x-navigation-layout>