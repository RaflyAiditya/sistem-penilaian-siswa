@extends('layout')

@section('content')
<h1>Edit Siswa</h1>

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

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection