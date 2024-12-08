<x-navigation-layout title="Tambah Pelajaran">

    <x-slot name="header">
        <div class="pt-4 ps-4">
            <h1 class="fs-5"><b>Tambah Pelajaran</b></h1>

            <x-breadcrumb :items="[
                ['name' => 'Home', 'url' => route('dashboard')],
                ['name' => 'Pelajaran', 'url' => route('subjects.index')],
                ['name' => 'Tambah Pelajaran', 'url' => null],
            ]" />
        </div>
    </x-slot>

    <div class="container-fluid px-4">
        <div class="card mt-4 mb-4">
            <div class="card-body ms-3 me-3">
                <form action="{{ route('subjects.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="subject_name" class="form-label">Nama Pelajaran</label>
                        <input type="text" name="subject_name" id="subject_name" class="form-control" required>
                        @error('subject_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="class" class="form-label">Kelas</label>
                        <select name="class" id="class" class="form-select" required>
                            <option value="">-- Pilih Kelas --</option>
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
                            <option value="">-- Pilih Guru --</option>
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
                            <option value="">-- Pilih Hari --</option>
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

                    <button type="submit" class="btn btn-success">Tambah Pelajaran</button>
                    <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</x-navigation-layout>