<table class="table table-bordered table-hover text-nowrap" style="font-size:0.95em; margin-left: auto; margin-right: auto;">
    <thead style="background-color: #f8f9fa">
        <tr>
            <th>Nama Siswa</th>
            <th class="text-center">Kelas</th>
            <th class="text-center">Kode Pelajaran</th>
            <th>Nama Pelajaran</th>
            <th>Guru</th>
            <th class="text-center">Nilai</th>
            @canany(['input nilai', 'mengelola data nilai'])
            <th class="text-center">Aksi</th>
            @endcanany
        </tr>
    </thead>
    <tbody class="table-sm align-middle table-group-divider">
        @forelse($grades as $studentGrades)
            @foreach($studentGrades as $grade)
                <tr>
                    <td>{{ $grade->student->name }}</td>
                    <td class="text-center">{{ $grade->student->class }}</td>
                    <td class="text-center">{{ $grade->subject->subjectName->subject_name_id ?? '-' }}</td>
                    <td>{{ $grade->subject->subjectName->subject_name ?? '-' }}</td>
                    <td>{{ $grade->subject->teacher->name }}</td>
                    <td class="text-center">{{ $grade->grade }}</td>
                    @canany(['memberikan nilai', 'mengelola data nilai'])
                    <td class="text-center" style="width: 10%">
                        @if(auth()->user()->hasRole('admin') || auth()->user()->nip_or_nis === $grade->subject->teacher->nip)
                            @if($grade->grade=='0')
                                <a data-bs-toggle="modal" data-bs-target="#editGradeModal-{{ $grade->id }}" class="btn btn-success btn-sm" style="font-size: 0.8rem;"><i class="fa-solid fa-file-pen"></i>&nbsp;input nilai</a>
                            @else
                                <a data-bs-toggle="modal" data-bs-target="#editGradeModal-{{ $grade->id }}" class="btn btn-warning btn-sm" style="font-size: 0.8rem;">&nbsp;<i class="fa-solid fa-pen-to-square"></i></i>&nbsp;edit nilai&nbsp;</a>
                            @endif
                        @endif
                    </td>
                    @endcanany
                </tr>
                <!-- Modal Input Nilai -->
                @include('grades.edit')
            @endforeach
        @empty
            <tr>
                <td colspan="8" class="text-center">Tidak ada data ditemukan.</td>
            </tr>
        @endforelse
    </tbody>
</table>