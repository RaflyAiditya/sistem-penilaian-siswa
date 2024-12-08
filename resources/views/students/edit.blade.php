<x-navigation-layout title="Edit Data Siswa">
    <x-slot name="header">
        <div class="pt-4 ps-4">
            <h1 class="fs-5"><b>Edit Data Siswa</b></h1>

            <x-breadcrumb :items="[
                ['name' => 'Home', 'url' => route('dashboard')],
                ['name' => 'Siswa', 'url' => route('students.index')],
                ['name' => 'Edit Data Siswa', 'url' => null],
            ]" />
        </div>
    </x-slot>

    <div class="container-fluid px-4">
        <div class="card mt-4 mb-4">
            <div class="card-body ms-3 me-3">
                <form action="{{ route('students.update', $student) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $student->name) }}"
                            required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="class" class="form-label">Kelas</label>
                        <select name="class" id="class" class="form-control" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($classes as $class)
                                <option value="{{ $class }}" {{ old('class', $student->class) == $class ? 'selected' : '' }}>
                                    {{ $class }}
                                </option>
                            @endforeach
                        </select>
                        @error('class')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{ old('email', $student->email) }}" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    <a href="{{ route('students.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</x-navigation-layout>