<x-navigation-layout title="Siswa">

    <x-slot name="header">
        <h1 class="fs-5"><b>Daftar Siswa</b></h1>
        <x-breadcrumb :items="[
            ['name' => 'Home', 'url' => route('dashboard')],
            ['name' => 'Siswa', 'url' => null]
        ]" />
    </x-slot>

    <div class="container-fluid px-4">
        @if(session('success'))
            <script>
                window.sessionSuccessMessage = '{{ session('success') }}';
            </script>
        @endif

        <div class="card mt-4" data-page-id="students-page">
            <div class="card-header">
                <ul class="nav justify-content-between mt-2">
                    <ul class="nav nav-tabs" role="tablist">
                        @foreach (['7' => 'Kelas 7', '8' => 'Kelas 8', '9' => 'Kelas 9'] as $key => $label)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $loop->first ? 'active' : '' }}" 
                                    id="kelas-{{ $key }}-tab" 
                                    data-bs-toggle="tab" 
                                    data-bs-target="#kelas-{{ $key }}-tab-pane" 
                                    type="button" 
                                    role="tab" 
                                    aria-controls="kelas-{{ $key }}-tab-pane" 
                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                    {{ $label }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    
                    @can('mengelola siswa')
                    <button class="btn btn-link mx-2 mb-2" style="padding: 0%">
                        <a href="{{ route('students.create') }}" class="btn btn-primary">
                            Tambah siswa
                        </a>
                    </button>
                    @endcan
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    @foreach (['7' => 'Kelas 7', '8' => 'Kelas 8', '9' => 'Kelas 9'] as $key => $label)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                            id="kelas-{{ $key }}-tab-pane" 
                            role="tabpanel" 
                            aria-labelledby="kelas-{{ $key }}-tab" 
                            tabindex="0">
                            @if ($studentsByClass[$key]->isNotEmpty())
                                <div class="table-responsive-lg">
                                    @include('students.table', ['students' => $studentsByClass[$key]])
                                </div>
                            @else
                                <p class="text-center">Tidak ada siswa untuk {{ $label }}.</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>     
        </div>  
    </div>
</x-navigation-layout>