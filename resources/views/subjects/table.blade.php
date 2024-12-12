<table class="table table-hover text-nowrap" style="font-size:0.95em">
    <thead>
        <tr>
            <th style="width: 30px"># </th>
            <th>Kode Pelajaran</th>
            <th>Nama Pelajaran</th>
            {{-- <th>Kelas</th> --}}
            <th>Nama Guru</th>
            <th>Waktu</th>
            <th style="width: 160px">Aksi</th>
        </tr>
    </thead>
    <tbody class="table-sm align-middle table-group-divider">
        @foreach($subjects as $subject)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $subject->subjectName->subject_name_id ?? '-' }}</td>
                <td>{{ $subject->subjectName->subject_name ?? '-' }}</td>
                {{-- <td>{{ $subject->class}}</td> --}}
                <td>{{ $subject->teacher->name}}</td>
                <td>{{ $subject->time_start ? \Carbon\Carbon::parse($subject->time_start)->format('H:i') : '-' }}
                    &#45 {{ $subject->time_end ? \Carbon\Carbon::parse($subject->time_end)->format('H:i') : '-' }}</td>
                <td>
                    <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i>&nbsp;edit</a>

                    <button class=" btn btn-link" style="margin: -0.25rem !important">
                        <form action="{{ route('subjects.destroy', $subject) }}" id="delete-form-{{ $subject->id }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $subject->id }})">
                                <i class="fa-solid fa-trash fa-sm"></i>&nbsp;hapus
                            </button>
                        </form>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
