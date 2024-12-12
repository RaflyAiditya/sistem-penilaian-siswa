<x-navigation-layout title="Edit Pengguna">

    <x-slot name="header">
        <h1 class="fs-5"><b>Edit Pengguna</b></h1>

        <x-breadcrumb :items="[
            ['name' => 'Home', 'url' => route('dashboard')],
            ['name' => 'Atur Pengguna', 'url' => route('users.index')],
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
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password" autocomplete="new-password">
                                    <button class="btn btn-outline-secondary" type="button" style="border: 1px solid #ced4da;" id="togglePassword">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </div>                        
                                <small class="text-muted">Minimal 8 karakter</small>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <div class="input-group">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                    <button class="btn btn-outline-secondary" type="button" style="border: 1px solid #ced4da;" id="togglePasswordConfirmation">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </div>                        
                                @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex mt-4 justify-content-start gap-2">
                                <button type="submit" class="btn btn-success"><i class="fa-solid fa-circle-check"></i>&nbsp;Simpan</button>
                                <a href="{{ route('users.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>&nbsp;Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-navigation-layout>