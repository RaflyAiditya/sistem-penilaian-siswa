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

        <div class="card my-4">
            @canany(['memberikan nilai', 'mengelola data nilai'])
            <div class="card-header py-0">
                <ul class="nav d-flex justify-content-between align-items-start flex-column flex-xl-row mx-2 pe-0">
                    <div class="d-flex justify-content-start flex-column flex-xl-row column-gap-2 mb-2">
                        <form method="GET" action="{{ route('grades.index') }}" id="class-filter-form" class="mt-3 mb-0">
                            <div class="input-group">
                                <label class="label-form-select" for="class">Pilih Kelas</label>
                                <select name="class" id="class" class="form-select" onchange="document.getElementById('class-filter-form').submit();">
                                    <option value="">Pilih...</option>
                                    @foreach($classes as $classItem)
                                        <option value="{{ $classItem->class }}" {{ $class == $classItem->class ? 'selected' : '' }}>
                                            {{ $classItem->class }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                        <form method="GET" action="{{ route('grades.index') }}" id="studentid-filter-form" class="mt-3 mb-0">
                            <div class="input-group">
                                <label class="label-form-select" for="student_id">Pilih Siswa</label>
                                <select name="student_id" id="student_id" class="form-select" onchange="document.getElementById('studentid-filter-form').submit();">
                                    {{-- <option value="">Semua Siswa</option> --}}
                                    <option value="">Pilih...</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}" {{ $studentId == $student->id ? 'selected' : '' }}>
                                            {{ $student->name }}
                                        </option>
                                        @endforeach
                                </select>
                            </div>
                        </form>
                        @can('mengelola data nilai')
                        <form method="GET" action="{{ route('grades.index') }}" id="teacherid-filter-form" class="mt-3 mb-0">
                            <div class="input-group">
                                <label class="label-form-select" for="teacher_id">Pilih Guru</label>
                                <select name="teacher_id" id="teacher_id" class="form-select" onchange="document.getElementById('teacherid-filter-form').submit();">
                                    <option value="">Pilih...</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" {{ $teacherId == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                        @endcan
                    </div>
                    <div class="d-flex flex-row justify-content-end column-gap-1 mb-3" style="margin-top: 0.9rem">
                        @can('mengelola data nilai')
                        <button class="btn btn-link p-0" style="cursor: default; text-decoration: none">
                            <a class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#createGradeModal">
                                Tambah data
                            </a>
                        </button>
                        <button class="btn btn-link p-0" style="cursor: default; text-decoration: none">
                            <a class="btn btn-danger d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#deleteGradeModal">
                                Hapus data
                            </a>
                        </button>
                        @endcan
                    </div>
                </ul>
            </div>
            @endcan

            <div class="card-body py-3">
                <div class="card shadow-sm p-1">
                        <div class="table-responsive-xl">
                        @include('grades.table', ['grades' => $grades])
                    </div>
                </div>
            </div>
            <!-- Modal Tambah Data Penilaian -->
            @include('grades.create')

            <!-- Modal Hapus Data Penilaian -->
            @include('grades.delete')
        </div>
    </div>  
</x-navigation-layout>