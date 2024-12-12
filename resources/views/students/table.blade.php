<div class="table-responsive-lg">
    <table class="table table-hover text-nowrap" style="font-size:0.95em">
        <thead>
            <tr>
                <th style="width: 30px"># </th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Email</th>
                <th style="width: 250px">Aksi</th>
                {{-- 18.7%" --}}
            </tr>
        </thead>
        <tbody class="table-sm align-middle table-group-divider">
            @forelse($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->class }}</td>
                    <td>{{ $student->email }}</td>
                    <td>
                        <a class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i>&nbsp;lihat nilai</a>
                        <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm "><i class="fa-solid fa-pen-to-square"></i>&nbsp;edit</a>

                        {{-- <form action="{{ route('students.destroy', $student) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">hapus</button>
                        </form> --}}

                        <button class="btn btn-link" style="margin: -0.29rem !important">
                            <form action="{{ route('students.destroy', $student) }}" method="POST" id="delete-form-{{ $student->id }}" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $student->id }})">
                                    <i class="fa-solid fa-trash fa-sm"></i>&nbsp;hapus
                                </button>
                            </form>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada siswa di kelas ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>