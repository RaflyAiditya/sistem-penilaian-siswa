<x-navigation-layout title="Nilai">

    <x-slot name="header">
            {{-- <div class="pt-3 pb-1 ps-4"> --}}
            <div class="pt-4 ps-4">
                <h1 class="fs-5"><b>Daftar Nilai</b></h1>

                <x-breadcrumb :items="[
                    ['name' => 'Home', 'url' => route('dashboard')],
                    ['name' => 'Nilai', 'url' => null]
                ]" />
            </div>
    </x-slot>

    <div class="container-fluid px-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card mt-4 mb-4">
            <div class="card-header">
                <div class="d-flex justify-end mx-2 my-2">
                    {{-- <i class="fas fa-table me-1"></i> --}}
                {{-- DataTable Example --}}
                    <a href="{{ route('grades.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>&nbsp;tambah nilai</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover table-responsive">
                {{-- <table id="datatablesSimple"> --}}
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
                    <tbody  class="table-sm align-middle table-group-divider">
                        @forelse($grades as $grade)
                            <tr>
                                <td>{{ $grade->student->name }}</td>
                                <td>{{ $grade->student->class }}</td>
                                <td>{{ $grade->subject->subject_name }}</td>
                                <td>{{ $grade->subject->teacher }}</td>
                                <td>{{ $grade->grade }}</td>
                                <td>
                                    <a href="{{ route('grades.edit', $grade) }}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i>&nbsp;edit</a>
                                    <form action="{{ route('grades.destroy', $grade) }}" method="POST" id="delete-form-{{ $grade->id }}" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $grade->id }})">
                                            <i class="fa-solid fa-trash fa-sm"></i>&nbsp;hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-navigation-layout>