<x-app-layout>
    @section('title')
    {{ "Daftar Nilai" }}
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Nilai') }}
        </h2>
    </x-slot>

    <div class="center container mt-4">
        <div class="d-flex justify-end align-items-center mb-4">
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
                            <form action="{{ route('grades.destroy', $grade) }}" method="POST"
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