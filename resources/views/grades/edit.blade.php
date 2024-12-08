<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Nilai') }}
        </h2>
    </x-slot>

    <div class="center container mt-4">
        <form action="{{ route('grades.update', $grade) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Dropdown untuk memilih siswa -->
            <div class="mb-3">
                <label for="student_id" class="form-label">Siswa</label>
                <select name="student_id" id="student_id" class="form-control" required>
                    <option value="">Pilih Siswa</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ $student->id == $grade->student_id ? 'selected' : '' }}>
                                {{ $student->name }}
                            </option>
                        @endforeach
                </select>
                @error('student_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Dropdown untuk memilih mata pelajaran -->
            <div class="mb-3">
                <label for="subject_id" class="form-label">Mata Pelajaran</label>
                <select name="subject_id" id="subject_id" class="form-control" required>
                    <option value="">Pilih Mata Pelajaran</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ $subject->id == $grade->subject_id ? 'selected' : '' }}>
                            {{ $subject->subject_name }}
                        </option>
                    @endforeach
                </select>
                @error('subject_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input nilai -->
            <div class="mb-3">
                <label for="grade" class="form-label">Nilai</label>
                <input type="number" name="grade" id="grade" class="form-control" min="0" max="100"
                    value="{{ old('grade', $grade->grade) }}" required>
                @error('grade')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('grades.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</x-app-layout>