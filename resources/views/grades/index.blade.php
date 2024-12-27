<x-navigation-layout title="Nilai">

    <x-slot name="header">
        <h1 class="fs-5"><b>Daftar Nilai</b></h1>

        <x-breadcrumb :items="[
            ['name' => 'Home', 'url' => route('dashboard')],
            ['name' => 'Nilai', 'url' => null]
        ]" />
    </x-slot>

    <div class="container-fluid px-4">
        @if(session('success'))
            <script>
                window.sessionSuccessMessage = '{{ session('success') }}';
            </script>
        @elseif(session('empty'))
            <script>
                window.sessionInfoMessage = '{{ session('empty') }}';
            </script>
        @endif

        <div class="card mt-4 mb-4">
            <div class="card-header my-0 py-0" style="background-color: #ffffff;">
                <ul class="nav justify-content-between">
                    <form method="GET" action="{{ route('grades.index') }}" id="filter-form" class="mt-3">
                        <div class="form-group">
                            <label class="mb-2" for="student_id">Pilih Siswa</label>
                            <select name="student_id" id="student_id" class="form-select" onchange="document.getElementById('filter-form').submit();">
                                <option value="">Semua Siswa</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}" {{ $studentId == $student->id ? 'selected' : '' }}>
                                        {{ $student->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                    @can('mengelola data nilai')
                    <button class="btn btn-link mx-2" style="cursor: default">
                        <a class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#createGradeModal">
                            Tambah data
                        </a>
                    </button>
                    @endcan
                </ul>
            </div>

            <div class="card-body pb-1">
                <div class="table-responsive-xl">
                    <table class="table table-hover text-nowrap" style="font-size:0.95em">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Kode Pelajaran</th>
                                <th>Nama Pelajaran</th>
                                <th>Guru</th>
                                <th>Nilai</th>
                                @canany(['input nilai', 'mengelola data nilai'])
                                <th>Aksi</th>
                                @endcanany
                            </tr>
                        </thead>
                        <tbody class="table-sm align-middle table-group-divider">
                            @forelse($grades as $studentGrades)
                                @foreach($studentGrades as $grade)
                                    <tr>
                                        <td>{{ $grade->student->name }}</td>
                                        <td>{{ $grade->student->class }}</td>
                                        <td>{{ $grade->subject->subjectName->subject_name_id ?? '-' }}</td>
                                        <td>{{ $grade->subject->subjectName->subject_name ?? '-' }}</td>
                                        <td>{{ $grade->subject->teacher->name }}</td>
                                        <td>{{ $grade->grade }}</td>
                                        <td style="width: 10%">
                                            @canany(['input nilai', 'mengelola data nilai'])
                                                @if(auth()->user()->hasRole('admin') || auth()->user()->nip_or_nis === $grade->subject->teacher->nip)
                                                    @if($grade->grade=='0')
                                                        <a data-bs-toggle="modal" data-bs-target="#editGradeModal-{{ $grade->id }}" class="btn btn-success btn-sm"><i class="fa-solid fa-file-pen"></i>&nbsp;input nilai</a>
                                                    @else
                                                        <a data-bs-toggle="modal" data-bs-target="#editGradeModal-{{ $grade->id }}" class="btn btn-warning btn-sm">&nbsp;<i class="fa-solid fa-pen-to-square"></i></i>&nbsp;edit nilai&nbsp;</a>
                                                    @endif
                                                @endif
                                            @endcanany
                                            {{-- @can('mengelola data nilai')
                                            <button class=" btn btn-link" style="margin: -0.25rem !important">    
                                                <form action="{{ route('grades.destroy', $grade) }}" id="delete-form-{{ $grade->id }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $grade->id }})">
                                                        <i class="fa-solid fa-trash fa-sm"></i>&nbsp;hapus
                                                    </button>
                                                </form>
                                            </button>
                                            @endcan --}}
                                        </td>
                                    </tr>
                                    <!-- Modal Input Nilai -->
                                    @include('grades.edit')
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Modal Tambah Data Penilaian -->
            @include('grades.create')

            <div class="card-footer mt-0 mb-2 pt-2" style="background-color: #ffffff;">
                <ul class="nav justify-content-end">
                    @can('mengelola data nilai')
                    </button>
                    <button class="btn btn-link mx-2" style="cursor: default; text-decoration: none">
                        <a class="btn btn-danger d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#deleteGradeModal">
                            Hapus data
                        </a>
                    </button>
                    @endcan
                </ul>
            </div>
            <!-- Modal Hapus Data Penilaian -->
            @include('grades.delete')
        </div>
    </div>
</x-navigation-layout>