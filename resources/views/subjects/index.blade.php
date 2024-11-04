@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Daftar Pelajaran</h2>
    <a href="{{ route('subjects.create') }}" class="btn btn-primary">Tambah Pelajaran</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Pelajaran</th>
            <th>Guru</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($subjects as $subject)
            <tr>
                <td>{{ $subject->subject_name}}</td>
                <td>{{ $subject->teacher}}</td>
                <td>
                    <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('subjects.destroy', $subject) }}" method="POST" style="display:inline-block;">
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