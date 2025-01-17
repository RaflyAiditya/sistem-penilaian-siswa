<table class="table table-bordered table-hover text-nowrap" style="font-size:0.95em">
    <thead style="background-color: #f8f9fa">
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">NIS</th>
            <th>Nama Siswa</th>
            <th class="text-center">Kelas</th>
            <th>Email</th>
            <th class="text-center">Aksi</th>
            {{-- 18.7%" --}}
        </tr>
    </thead>
    <tbody class="table-sm align-middle table-group-divider">
        @forelse($students as $student)
            <tr>
                <td style="width: 30px">{{ $loop->iteration }}</td>
                <td class="text-center">{{ $student->nis }}</td>
                <td>{{ $student->name }}</td>
                <td class="text-center">{{ $student->class }}</td>
                <td>{{ $student->email }}</td>
                <td class="text-center" style="width: 10%">
                    @if(auth()->user()->hasRole('admin') || auth()->user()->nip_or_nis === $student->nis || (auth()->user()->hasRole('guru') && $teacherClasses->contains($student->class)))
                        <a href="{{ route('grades.index', ['student_id' => $student->id]) }}" class="btn btn-info btn-sm" style="font-size: 0.8rem;"><i class="fa-solid fa-eye"></i>&nbsp;lihat nilai</a>
                        @can('mengelola siswa')
                        <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm" style="font-size: 0.8rem;"><i class="fa-solid fa-pen-to-square"></i>&nbsp;edit</a>
                        <button class="btn btn-link" style="margin: -0.29rem !important">
                            <form action="{{ route('students.destroy', $student) }}" method="POST" id="delete-form-{{ $student->id }}" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm" style="font-size: 0.8rem;" onclick="confirmDelete({{ $student->id }})">
                                    <i class="fa-solid fa-trash fa-sm"></i>&nbsp;hapus
                                </button>
                            </form>
                        </button>
                        @endcan
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada siswa di kelas ini.</td>
            </tr>
        @endforelse
    </tbody>
</table>