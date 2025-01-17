<x-navigation-layout title="Edit Data Siswa">
    <x-slot name="header">
        <h1 class="fs-5"><b>Edit Data Siswa</b></h1>
        <x-breadcrumb :items="[
            ['name' => 'Home', 'url' => route('dashboard')],
            ['name' => 'Siswa', 'url' => route('students.index')],
            ['name' => 'Edit Data Siswa', 'url' => null],
        ]" />
    </x-slot>

    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-4 mx-4">
                    <div class="card-body mx-4 mt-3">
                        <form action="{{ route('students.update', $student->id) }}" method="POST">
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
                                <select name="class" id="class" class="form-select" required>
                                    {{-- @foreach ($classes as $class) --}}
                                    @foreach (['7', '8', '9'] as $class)
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
                            <div class="d-flex mt-4 justify-content-start gap-2">
                                <button type="submit" class="btn btn-success" style="font-size: 0.9rem;"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Simpan</button>
                                <a href="{{ route('students.index') }}" class="btn btn-secondary" style="font-size: 0.9rem;"><i class="fa-solid fa-ban"></i>&nbsp;Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-navigation-layout>