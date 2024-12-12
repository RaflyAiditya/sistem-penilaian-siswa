<x-navigation-layout title="Pelajaran">

    <x-slot name="header">
        <h1 class="fs-5"><b>Daftar Pelajaran</b></h1>
        <x-breadcrumb :items="[
            ['name' => 'Home', 'url' => route('dashboard')],
            ['name' => 'Pelajaran', 'url' => null]
        ]" />
    </x-slot>

    <div class="container-fluid px-4">
        @if(session('success'))
            <script>
                window.sessionSuccessMessage = '{{ session('success') }}';
            </script>
        @endif

        <div class="card my-4" data-page-id="subjects-page">
            <div class="card-header">
                <ul class="nav nav-tabs justify-content-between">
                    <ul class="nav nav-tabs justify-content-between" role="tablist">
                        @foreach ($dayMapping as $key => $dayName)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $loop->first ? 'active' : '' }}" 
                                id="day-{{ $key }}-tab" 
                                data-bs-toggle="tab" 
                                data-bs-target="#day-{{ $key }}-tab-pane" 
                                type="button" 
                                role="tab" 
                                aria-controls="day-{{ $key }}-tab-pane" 
                                aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                    {{ $dayName }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <button class=" btn btn-link mx-2 mb-2" style="padding: 0%">
                        <a href="{{ route('subjects.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>&nbsp;Tambah pelajaran</a>
                    </button>
                </ul>
            </div>

            <div class="card-body pb-0" style="background-color: #ffffff; border-radius: 10px">
                <div class="tab-content" id="myTabContent">
                    @foreach ($dayMapping as $key => $dayName)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                            id="day-{{ $key }}-tab-pane" 
                            role="tabpanel" 
                            aria-labelledby="day-{{ $key }}-tab" 
                            tabindex="0">
                            @if ($subjectsByDayAndClass[$key]->isNotEmpty())
                                @foreach ($subjectsByDayAndClass[$key] as $class => $subjects)

                                <div class="card shadow-sm mb-4">
                                    <div class="card-header bg-light">
                                        <h2 class="card-title fs-6 fw-bold mb-0 text-center" style="color: #1a1d20">Kelas {{ $class }}</h2>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive-lg">
                                        @include('subjects.table', ['subjects' => $subjects])
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            @else
                                <p class="text-center">Tidak ada pelajaran untuk hari ini.</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>     
        </div>  
    </div>
</x-navigation-layout>