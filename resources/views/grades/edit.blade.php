<div class="modal fade" id="editGradeModal-{{ $grade->id }}" tabindex="-1" aria-labelledby="editGradeModalLabel-{{ $grade->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered d-flex justify-content-center">
        <div class="modal-content"style="width: 500px">
            <div class="modal-header">
                <h5 class="modal-title" id="editGradeModalLabel-{{ $grade->id }}">
                    @if($grade->grade=='0') Input Nilai
                    @else Edit Nilai
                    @endif
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Informasi Siswa -->
                <div class="mb-3">
                    <strong style="margin-right: 23px">Nama Siswa</strong><strong>:</strong> {{ $grade->student->name }}<br>
                    <strong style="margin-right: 73px">Kelas</strong><strong>:</strong> {{ $grade->student->class }}<br>
                    <strong>Mata Pelajaran&nbsp;:</strong> {{ $grade->subject->subjectName->subject_name ?? '-' }}<br>
                    <strong style="margin-right: 76px">Guru</strong><strong>:</strong> {{ $grade->subject->teacher->name }}<br>
                </div>
                <p class="text-muted small">
                    <strong>Catatan : </strong><br>
                    {{ __('Apabila nilai yang diinputkan berupa desimal, pembatas desimal koma (,) akan diubah otomatis menjadi titik (.)') }}
                </p>
                <form action="{{ route('grades.update', $grade->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="grade">Nilai:</label>
                        <input type="text" name="grade" id="grade" class="form-control" min="0" max="100" value="{{ old('grade', $grade->grade) }}" required
                            inputmode="decimal" oninput="sanitizeInput(this)">
                        @error('grade')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success mt-3" style="font-size: 0.9rem;"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>