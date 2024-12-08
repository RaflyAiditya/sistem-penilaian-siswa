<x-navigation-layout title="Siswa">

    <x-slot name="header">
        <div class="pt-4 ps-4">
            <h1 class="fs-5"><b>Daftar Siswa</b></h1>

            <x-breadcrumb :items="[
                ['name' => 'Home', 'url' => route('dashboard')],
                ['name' => 'Siswa', 'url' => null]
            ]" />
        </div>
    </x-slot>

    <div class="container-fluid px-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <div class="card mt-4">
            <div class="card-header">
                <ul class="nav nav-tabs justify-between">
                    <ul class="nav nav-tabs justify-between" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="kelas7-tab" data-bs-toggle="tab" data-bs-target="#kelas7-tab-pane" type="button" role="tab" aria-controls="kelas7-tab-pane" aria-selected="true">Kelas 7</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="kelas8-tab" data-bs-toggle="tab" data-bs-target="#kelas8-tab-pane" type="button" role="tab" aria-controls="kelas8-tab-pane" aria-selected="false">Kelas 8</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="kelas9-tab" data-bs-toggle="tab" data-bs-target="#kelas9-tab-pane" type="button" role="tab" aria-controls="kelas9-tab-pane" aria-selected="false">Kelas 9</a>
                        </li>
                    </ul>
                    <button class="d-flex justify-end mx-2 my-2">
                        <a href="{{ route('students.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>&nbsp;tambah siswa</a>
                    </button>
                </ul>
                {{-- <div class="d-flex justify-end mx-2 my-2"> --}}
                {{-- </div> --}}
            </div>

            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="kelas7-tab-pane" role="tabpanel" aria-labelledby="kelas7-tab" tabindex="0">
                        @include('students.table', ['students' => $studentsByClass['7']])
                    </div>
                    <div class="tab-pane fade" id="kelas8-tab-pane" role="tabpanel" aria-labelledby="kelas8-tab" tabindex="0">
                        @include('students.table', ['students' => $studentsByClass['8']])
                    </div>
                    <div class="tab-pane fade" id="kelas9-tab-pane" role="tabpanel" aria-labelledby="kelas9-tab" tabindex="0">
                        @include('students.table', ['students' => $studentsByClass['9']])
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-navigation-layout>