<x-navigation-layout title="Dashboard">

    <x-slot name="header">
        <h1 class="fs-5"><b>Dashboard</b></h1>
        <x-breadcrumb :items="[
            ['name' => 'Home', 'url' => route('dashboard')]
        ]" />
    </x-slot>

    <div class="py-4">
        <!-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> -->
        <div class="container">
            <div class="mx-4 bg-white overflow-hidden shadow-sm" style="border-radius: 10px">
            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> --}}
                <div class="p-4 fs-6 fw-medium">
                    {{ __("Anda berhasil masuk!") }}
                    <br> Hai {{ Auth::user()->name }}.
                    Selamat datang di Sistem Penilaian Siswa
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row d-flex justify-content-center mx-3" style="background-color: #e9ecef">
            @if(auth()->user()->hasRole(['admin', 'guru']))
            <div class="col-md-3 rounded-lg p-0 mb-2">
                <div class="card shadow-sm py-3 mx-2" style="border-radius: 10px">
                    <div class="col">
                        <div class="d-flex justify-content-center ms-3 me-3 my-0">
                            <i class="fa-solid fa-book-open fs-3"></i>
                        </div>
                        <div class="d-flex align-items-center flex-column">
                            <h6 class="text-center fw-medium m-2">Pelajaran Belum Dinilai</h6>
                            <p class=" d-flex align-items-center fs-5 fw-semibold my-0">{{ $totalUngradedSubjects }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 rounded-lg p-0 mb-2">
                <div class="card shadow-sm py-3 mx-2" style="border-radius: 10px">
                    <div class="col">
                        <div class="d-flex justify-content-center ms-3 me-3 my-0">
                            <i class="fa-solid fa-people-group fs-3"></i>
                        </div>
                        <div class="d-flex align-items-center flex-column">
                            <h6 class="text-center fw-medium m-2">Total Siswa</h6>
                            <p class=" d-flex align-items-center fs-5 fw-semibold my-0">{{ $totalStudents }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if(auth()->user()->hasRole('admin'))
            <div class="col-md-3 rounded-lg p-0 mb-2">
                <div class="card shadow-sm py-3 mx-2" style="border-radius: 10px">
                    <div class="col">
                        <div class="d-flex justify-content-center ms-3 me-3 my-0">
                            <i class="fa-solid fa-layer-group fs-3"></i>
                        </div>
                        <div class="d-flex align-items-center flex-column">
                            <h6 class="text-center fw-medium m-2">Total Mata Pelajaran</h6>
                            <p class=" d-flex align-items-center fs-5 fw-semibold my-0">{{ $totalSubjects }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 rounded-lg p-0 mb-2">
                <div class="card shadow-sm py-3 mx-2" style="border-radius: 10px">
                    <div class="col">
                        <div class="d-flex justify-content-center ms-3 me-3 my-0">
                            <i class="fas fa-user fs-3"></i>
                        </div>
                        <div class="d-flex align-items-center flex-column">
                            <h6 class="text-center fw-medium m-2">Total Pengguna</h6>
                            <p class=" d-flex align-items-center fs-5 fw-semibold my-0">{{ $totalUsers }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="container mb-4">
        <div class="mt-3 mx-4 bg-white overflow-hidden shadow-sm" style="border-radius: 10px">
            <h5 class="text-xl text-center fw-bold mt-3 mb-0">Nilai Terbaru</h5>
            <div class="card-body py-3 mx-3">
                <div class="card shadow-sm p-1">
                    <div class="table-responsive-xl">
                        <table class="table table-bordered text-nowrap" style="font-size:0.95em; margin-left: auto; margin-right: auto;">
                            <thead class="fw-semibold" style="font-size:1.1em; background-color: #f8f9fa">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Nama Siswa</th>
                                    <th class="text-center">Kelas</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Guru</th>
                                    <th class="text-center">Nilai</th>
                                    <th class="text-center">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="table-sm align-middle table-group-divider">
                                @foreach($recentGrades as $grade)
                                    <tr>
                                        <td class="text-center" style="width: 30px">{{ $loop->iteration }}</td>
                                        <td>{{ $grade->student->name }}</td>
                                        <td class="text-center">{{ $grade->student->class }}</td>
                                        <td>{{ $grade->subject->subjectName->subject_name }}</td>
                                        <td>{{ $grade->subject->teacher->name }}</td>
                                        <td class="text-center">{{ $grade->grade }}</td>
                                        <td class="text-center">{{ $grade->updated_at->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>       
    </div>
</x-navigation-layout>