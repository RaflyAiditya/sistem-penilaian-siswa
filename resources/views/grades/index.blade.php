@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Daftar Nilai</h2>
    <a href="{{ route('grades.create') }}" class="btn btn-primary">Tambah Nilai</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Mata Pelajaran</th>
            <th>Guru</th>
            <th>Nilai</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($grades as $grade)
            <tr>
                <td>{{ $grade->student->name }}</td>
                <td>{{ $grade->student->class }}</td>
                <td>{{ $grade->subject->subject_name }}</td>
                <td>{{ $grade->subject->teacher }}</td>
                <td>{{ $grade->grade }}</td>
                <td>
                    <a href="{{ route('grades.edit', $grade) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('grades.destroy', $grade) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection