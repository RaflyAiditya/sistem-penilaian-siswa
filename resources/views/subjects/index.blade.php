<x-navigation-layout title="Pelajaran">

    <x-slot name="header">
        <div class="pt-4 ps-4">
            <h1 class="fs-5"><b>Daftar Pelajaran</b></h1>

            <x-breadcrumb :items="[
                ['name' => 'Home', 'url' => route('dashboard')],
                ['name' => 'Pelajaran', 'url' => null]
            ]" />
        </div>
    </x-slot>

    <div class="container-fluid px-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- <div class="d-flex justify-end align-items-center mb-4">
            <a href="{{ route('subjects.create') }}" class="btn btn-primary">Tambah Pelajaran</a>
        </div>     --}}

        <div class="card mt-4">
            <div class="card-header">
                <ul class="nav nav-tabs justify-content-between">
                    {{-- <ul class="nav nav-tabs justify-between" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="senin-tab" data-bs-toggle="tab" data-bs-target="#senin-tab-pane" type="button" role="tab" aria-controls="senin-tab-pane" aria-selected="true">Senin</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="selasa-tab" data-bs-toggle="tab" data-bs-target="#selasa-tab-pane" type="button" role="tab" aria-controls="selasa-tab-pane" aria-selected="false">Selasa</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="rabu-tab" data-bs-toggle="tab" data-bs-target="#rabu-tab-pane" type="button" role="tab" aria-controls="rabu-tab-pane" aria-selected="false">Rabu</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="kamis-tab" data-bs-toggle="tab" data-bs-target="#kamis-tab-pane" type="button" role="tab" aria-controls="kamis-tab-pane" aria-selected="false">Kamis</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="jumat-tab" data-bs-toggle="tab" data-bs-target="#jumat-tab-pane" type="button" role="tab" aria-controls="jumat-tab-pane" aria-selected="false">Jumat</a>
                        </li>
                    </ul> --}}


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
                        <a href="{{ route('subjects.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>&nbsp;tambah pelajaran</a>
                    </button>
                </ul>
            </div>

            <div class="card-body">
                {{-- <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="senin-tab-pane" role="tabpanel" aria-labelledby="senin-tab" tabindex="0">
                        @include('subjects.table', ['subjects' => $subjectsByDay['1']])
                    </div>
                    <div class="tab-pane fade" id="selasa-tab-pane" role="tabpanel" aria-labelledby="selasa-tab" tabindex="0">
                        @include('subjects.table', ['subjects' => $subjectsByDay['2']])
                    </div>
                    <div class="tab-pane fade" id="rabu-tab-pane" role="tabpanel" aria-labelledby="rabu-tab" tabindex="0">
                        @include('subjects.table', ['subjects' => $subjectsByDay['3']])
                    </div>
                    <div class="tab-pane fade" id="kamis-tab-pane" role="tabpanel" aria-labelledby="kamis-tab" tabindex="0">
                        @include('subjects.table', ['subjects' => $subjectsByDay['4']])
                    </div>
                    <div class="tab-pane fade" id="jumat-tab-pane" role="tabpanel" aria-labelledby="jumat-tab" tabindex="0">
                        @include('subjects.table', ['subjects' => $subjectsByDay['5']])
                    </div>
                </div> --}}

                <div class="tab-content" id="myTabContent">
                    @foreach ($dayMapping as $key => $dayName)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                            id="day-{{ $key }}-tab-pane" 
                            role="tabpanel" 
                            aria-labelledby="day-{{ $key }}-tab" 
                            tabindex="0">
                            @if ($subjectsByDayAndClass[$key]->isNotEmpty())
                                @foreach ($subjectsByDayAndClass[$key] as $class => $subjects)
                                    <h5 class="mt-4">Kelas : {{ $class }}</h5>
                                    @include('subjects.table', ['subjects' => $subjects])
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