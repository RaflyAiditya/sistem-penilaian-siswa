<x-app-layout>
    @section('title')
    {{ "Daftar Pelajaran" }}
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pelajaran') }}
        </h2>
    </x-slot>

    <div class="center container mt-4">
        <div class="d-flex justify-end align-items-center mb-4">
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
                            <form action="{{ route('subjects.destroy', $subject) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>