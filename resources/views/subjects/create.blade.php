<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Pelajaran') }}
        </h2>
    </x-slot>

    <div class="center container mt-4">
        <form action="{{ route('subjects.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="subject_name" class="form-label">Nama Pelajaran</label>
                <input type="text" name="subject_name" id="subject_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="teacher" class="form-label">Guru</label>
                <input type="text" name="teacher" id="teacher" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Tambah Pelajaran</button>
            <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</x-app-layout>