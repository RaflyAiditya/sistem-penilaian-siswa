@extends('layout')

@section('content')
<h1>Tambah Pelajaran</h1>

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
@endsection