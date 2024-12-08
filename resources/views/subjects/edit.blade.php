<x-navigation-layout title="Edit Data Pelajaran">

    <x-slot name="header">
        <div class="pt-4 ps-4">
            <h1 class="fs-5"><b>Edit Data Pelajaran</b></h1>

            <x-breadcrumb :items="[
                ['name' => 'Home', 'url' => route('dashboard')],
                ['name' => 'Pelajaran', 'url' => route('subjects.index')],
                ['name' => 'Edit Data Pelajaran', 'url' => null],
            ]" />
        </div>
    </x-slot>

    <div class="container-fluid px-4">
        <div class="card mt-4 mb-4">
            <div class="card-body ms-3 me-3">
                <form action="{{ route('subjects.update', $subject) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="subject_name" class="form-label">Nama Pelajaran</label>
                        <input type="text" name="subject_name" id="subject_name" class="form-control"
                            value="{{ old('subject_name', $subject->subject_name) }}" required>
                        @error('subject_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="teacher" class="form-label">Kelas</label>
                        <input type="text" name="teacher" id="teacher" class="form-control"
                            value="{{ old('teacher', $subject->teacher) }}" required>
                        @error('teacher')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</x-navigation-layout>