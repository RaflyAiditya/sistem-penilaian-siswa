<x-navigation-layout title="Tambah Pelajaran">

    <x-slot name="header">
        <h1 class="fs-5"><b>Tambah Pelajaran</b></h1>
        <x-breadcrumb :items="[
            ['name' => 'Home', 'url' => route('dashboard')],
            ['name' => 'Pelajaran', 'url' => route('subjects.index')],
            ['name' => 'Tambah Pelajaran', 'url' => null],
        ]" />
    </x-slot>

    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-4 mx-4">
                    <div class="card-body mx-4 mt-3">
                        <form action="{{ route('subjects.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="subject_name_id" class="form-label">Nama Pelajaran</label>
                                <select name="subject_name_id" id="subject_name_id" class="form-select" required>
                                    <option selected disabled value="">Pilih Pelajaran...</option>
                                    @foreach ($subjectNames as $subjectName)
                                        <option value="{{ $subjectName->subject_name_id }}" {{ old('subject_name_id') == $subjectName->subject_name_id ? 'selected' : '' }}>
                                            {{ $subjectName->subject_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('subject_name_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="class" class="form-label">Kelas</label>
                                <select name="class" id="class" class="form-select" required>
                                    <option selected disabled value="">Pilih Kelas...</option>
                                    @foreach (['7', '8', '9'] as $class)
                                        <option value="{{ $class }}" {{ old('class') == $class ? 'selected' : '' }}>
                                            {{ $class }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('class')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="teacher_id" class="form-label">Guru</label>
                                <select name="teacher_id" id="teacher_id" class="form-select" required>
                                    <option selected disabled value="">Pilih Guru...</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('teacher_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="day" class="form-label">Hari</label>
                                <select name="day" id="day" class="form-select" required>
                                    <option selected disabled value="">Pilih Hari...</option>
                                    @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $day)
                                        <option value="{{ $day }}" {{ old('day') == $day ? 'selected' : '' }}>
                                            {{ $day }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('day')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="time_start" class="form-label">Waktu Mulai</label>
                                <input type="time" name="time_start" id="time_start" class="form-control" value="{{ old('time_start') }}" required>
                                @error('time_start')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="time_end" class="form-label">Waktu Selesai</label>
                                <input type="time" name="time_end" id="time_end" class="form-control" value="{{ old('time_end') }}" required>
                                @error('time_end')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            @if ($errors->has('conflict'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('conflict') }}
                                </div>
                            @endif
                            <div class="d-flex mt-4 justify-content-start gap-2">
                                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Tambah</button>
                                <a href="{{ route('subjects.index') }}" class="btn btn-secondary"><i class="fa-solid fa-ban"></i>&nbsp;Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-navigation-layout>