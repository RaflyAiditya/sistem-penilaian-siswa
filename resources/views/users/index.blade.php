<x-navigation-layout title="Akun">

    <x-slot name="header">
        <h1 class="fs-5"><b>Akun</b></h1>

        <x-breadcrumb :items="[
            ['name' => 'Home', 'url' => route('dashboard')],
            ['name' => 'Pengguna', 'url' => null],
            ['name' => 'Akun', 'url' => null]
        ]" />
    </x-slot>

    <div class="container-fluid px-4">
        {{-- <div class="d-flex justify-end align-items-center mb-4">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah Pengguna</a>
        </div> --}}

        @if(session('success'))
            <script>
                window.sessionSuccessMessage = '{{ session('success') }}';
            </script>
        @endif

        <div class="card mt-4 mb-4">
            <div class="card-body">
                <div class="table-responsive-lg">
                    <table class="table table-hover text-nowrap" style="font-size:0.95em">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>NIP atau NIS</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-sm align-middle table-group-divider">
                            @foreach($users as $user)
                                <tr>
                                    <td style="width: 30px">{{ $loop->iteration }}</td>
                                    <td>{{ $user->name}}</td>
                                    <td>{{ $user->nip_or_nis}}</td>
                                    <td>{{ $user->email}}</td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            <span class="badge bg-primary fs-6">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                    <td style="width: 10%">
                                        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i>&nbsp;edit</a>

                                        <button class=" btn btn-link" style="margin: -0.25rem !important">
                                            <form action="{{ route('users.destroy', $user) }}" id="delete-form-{{ $user->id }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDeleteUser('{{ $user->id }}', '{{ route('users.destroy', $user) }}')">
                                                    <i class="fa-solid fa-trash fa-sm"></i>&nbsp;hapus
                                                </button>
                                            </form>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-navigation-layout>