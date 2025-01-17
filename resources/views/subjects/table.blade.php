<table class="table table-bordered table-hover text-nowrap" style="font-size:0.95em">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Kode Pelajaran</th>
            <th>Mata Pelajaran</th>
            {{-- <th>Kelas</th> --}}
            <th>Guru</th>
            <th class="text-center">Waktu</th>
            @can('mengelola daftar pelajaran')
            <th class="text-center">Aksi</th>
            @endcan
        </tr>
    </thead>
    <tbody class="table-sm align-middle table-group-divider">
        @foreach($subjects as $subject)
            <tr>
                <td class="text-center" style="width: 30px">{{ $loop->iteration }}</td>
                <td class="text-center">{{ $subject->subjectName->subject_name_id ?? '-' }}</td>
                <td>{{ $subject->subjectName->subject_name ?? '-' }}</td>
                {{-- <td>{{ $subject->class}}</td> --}}
                <td>{{ $subject->teacher->name}}</td>
                <td class="text-center">{{ $subject->time_start ? \Carbon\Carbon::parse($subject->time_start)->format('H:i') : '-' }}
                    &#45 {{ $subject->time_end ? \Carbon\Carbon::parse($subject->time_end)->format('H:i') : '-' }}</td>
                @can('mengelola daftar pelajaran')
                <td  class="text-center" style="width: 10%">
                    <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-warning btn-sm" style="font-size: 0.8rem;"><i class="fa-solid fa-pen-to-square"></i>&nbsp;edit</a>

                    <button class=" btn btn-link" style="margin: -0.25rem !important">
                        <form action="{{ route('subjects.destroy', $subject) }}" id="delete-form-{{ $subject->id }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm" style="font-size: 0.8rem;" onclick="confirmDelete({{ $subject->id }})">
                                <i class="fa-solid fa-trash fa-sm"></i>&nbsp;hapus
                            </button>
                        </form>
                    </button>
                </td>
                @endcan
            </tr>
        @endforeach
    </tbody>
</table>
