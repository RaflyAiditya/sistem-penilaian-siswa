@extends('layout')

@section('content')
<h1>Tambah Siswa</h1>

<form action="{{ route('students.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="class" class="form-label">Kelas</label>
        <input type="text" name="class" id="class" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Tambah Siswa</button>
    <a href="{{ route('students.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection