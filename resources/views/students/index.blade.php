@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Daftar Siswa</h2>
    <a href="{{ route('students.create') }}" class="btn btn-primary">Tambah Siswa</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->class }}</td>
                <td>{{ $student->email }}</td>
                <td>
                    <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline-block;">
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