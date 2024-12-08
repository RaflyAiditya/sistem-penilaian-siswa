<x-navigation-layout title="Tambah Siswa">
    <x-slot name="header">
        <div class="pt-4 ps-4">
            <h1 class="fs-5"><b>Tambah Siswa</b></h1>

            <x-breadcrumb :items="[
                ['name' => 'Home', 'url' => route('dashboard')],
                ['name' => 'Siswa', 'url' => route('students.index')],
                ['name' => 'Tambah Siswa', 'url' => null],
            ]" />
        </div>
    </x-slot>

    <div class="container-fluid px-4">
        <div class="card mt-4 mb-4">
            <div class="card-body ms-3 me-3">
                <form action="{{ route('students.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="class" class="form-label">Kelas</label>
                        <select name="class" id="class" class="form-control" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($classes as $class)
                                <option value="{{ $class }}" {{ old('class') == $class ? 'selected' : '' }}>
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
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Tambah</button>
                    <a href="{{ route('students.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</x-navigation-layout>