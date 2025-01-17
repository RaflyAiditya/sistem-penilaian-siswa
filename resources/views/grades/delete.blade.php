<div class="modal fade" id="deleteGradeModal" tabindex="-1" aria-labelledby="deleteGradeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered d-flex justify-content-center">
        <div class="modal-content px-4" style="width: 500px">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteGradeModalLabel">Hapus Data Penilaian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted small">
                    {{ __('Daripada menghapus data satu per satu, Anda dapat langsung menghapus data berdasarkan kategori.') }}
                </p>
                <form action="{{ route('grades.deleteByCategory') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="form-group mb-3">
                        <label class="mb-2">Pilih Kategori Penghapusan</label>
                        <select name="category_type" id="delete_category_type" class="form-select" required>
                            <option value="">Pilih Kategori...</option>
                            <option value="class">Berdasarkan Kelas</option>
                            <option value="student">Berdasarkan Siswa</option>
                        </select>
                    </div>

                    <div class="form-group mb-3" id="delete_class_selection" style="display: none;">
                        <label class="mb-2">Pilih Kelas</label>
                        <select name="class" id="class" class="form-control">
                            <option value="">Kelas...</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->class }}">{{ $class->class }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3" id="delete_student_selection" style="display: none;">
                        <label class="mb-2">Pilih Siswa</label>
                        <select name="student_id" id="student_id" class="form-control">
                            <option value="">Siswa...</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->class }})</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-danger mt-3" style="font-size: 0.9rem;"><i class="fa-solid fa-trash"></i>&nbsp;Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>