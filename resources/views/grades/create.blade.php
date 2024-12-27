<div class="modal fade" id="createGradeModal" tabindex="-1" aria-labelledby="createGradeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered d-flex justify-content-center">
        <div class="modal-content px-4" style="width: 500px">
            <div class="modal-header">
                <h5 class="modal-title" id="createGradeModalLabel">Tambah Data Penilaian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- <p class="text-muted small">
                    {{ __('Silakan pilih kelas dari siswa yang ingin Anda tambahkan datanya untuk penilaian.') }}
                </p> --}}
                <form action="{{ route('grades.store') }}" method="POST">
                    @csrf
                    {{-- <div class="form-group">
                        <label class="mb-2">Pilih Kelas</label>
                        <select name="class" id="class" class="form-select" required>
                            <option value="">Kelas...</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->class }}">{{ $class->class }}</option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div class="form-group mb-3">
                        <label class="mb-2">Pilih Kategori</label>
                        <select name="category_type" id="create_category_type" class="form-select" required>
                            <option value="">Pilih Kategori...</option>
                            <option value="class">Berdasarkan Kelas</option>
                            <option value="student">Berdasarkan Siswa</option>
                        </select>
                    </div>

                    <div class="form-group mb-3" id="create_class_selection" style="display: none;">
                        <label class="mb-2">Pilih Kelas</label>
                        <select name="class" id="class" class="form-select">
                            <option value="">Kelas...</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->class }}">{{ $class->class }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3" id="create_student_selection" style="display: none;">
                        <label class="mb-2">Pilih Siswa</label>
                        <select name="student_id" id="student_id" class="form-select">
                            <option value="">Pilih Siswa...</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->class }})</option>
                            @endforeach
                        </select>
                    </div>
               
                    <div id="students-subjects-container"></div>
                
                    <button type="submit" class="btn btn-success mt-3"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>