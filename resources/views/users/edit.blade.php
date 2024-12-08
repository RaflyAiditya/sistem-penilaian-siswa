<x-navigation-layout title="Edit Pengguna">

    <x-slot name="header">
        <div class="pt-4 ps-4">
            <h1 class="fs-5"><b>Edit Pengguna</b></h1>

            <x-breadcrumb :items="[
                ['name' => 'Home', 'url' => route('dashboard')],
                ['name' => 'Atur Pengguna', 'url' => route('users.index')],
                ['name' => 'Edit', 'url' => null],
            ]" />
        </div>
    </x-slot>

    <div class="container-fluid px-4">
        <div class="card mt-4 mb-4">
            <div class="card-body ms-3 me-3">
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
                        {{-- <select name="roles[]" id="roles" class="form-select" multiple required> --}}
                        <select name="roles[]" id="roles" class="form-select" required>
                            <option value="">-- Pilih Role --</option>
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

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</x-navigation-layout>