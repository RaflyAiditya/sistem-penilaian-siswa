<x-navigation-layout title="Akun">

    <x-slot name="header">
        <h1 class="fs-5"><b>Daftar Akun</b></h1>

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

        <div class="card my-4">
            <div class="card-body shadow-sm py-3">
            <div class="card shadow-sm p-1">
                <div class="table-responsive-xl">
                    <table class="table table-bordered table-hover text-nowrap" style="font-size:0.95em">
                        <thead style="background-color: #f8f9fa">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama</th>
                                <th class="text-center">NIP atau NIS</th>
                                <th>Email</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Tanggal Dibuat</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-sm align-middle table-group-divider">
                            @foreach($users as $user)
                                <tr>
                                    <td class="text-center" style="width: 30px">{{ $loop->iteration }}</td>
                                    <td>{{ $user->name}}</td>
                                    <td class="text-center">{{ $user->nip_or_nis}}</td>
                                    <td>{{ $user->email}}</td>
                                    <td class="text-center">
                                        @foreach ($user->roles as $role)
                                            <span class="badge bg-primary" style="font-size: 0.8rem">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="text-center">{{ $user->created_at->format('d-m-Y') }}</td>
                                    <td class="text-center" style="width: 10%">
                                        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm" style="font-size: 0.8rem;"><i class="fa-solid fa-pen-to-square"></i>&nbsp;edit</a>

                                        <button class=" btn btn-link" style="margin: -0.25rem !important">
                                            <form action="{{ route('users.destroy', $user) }}" id="delete-form-{{ $user->id }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm" style="font-size: 0.8rem;" onclick="confirmDeleteUser('{{ $user->id }}', '{{ route('users.destroy', $user) }}')">
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
    </div>
</x-navigation-layout>