<x-navigation-layout title="Role">

    <x-slot name="header">
        <h1 class="fs-5"><b>Role</b></h1>

        <x-breadcrumb :items="[
            ['name' => 'Home', 'url' => route('dashboard')],
            ['name' => 'Pengguna', 'url' => null],
            ['name' => 'Role', 'url' => null]
        ]" />
    </x-slot>

    <div class="container-fluid px-4">
        @if(session('success'))
            <script>
                window.sessionSuccessMessage = '{{ session('success') }}';
            </script>
        @elseif(session('error'))
            <script>
                window.sessionInfoMessage = '{{ session('error') }}';
            </script>
        @endif

        <div class="row justify-content-center">
            
            <!-- Create Role Form -->
            <div class="col-md-8">
                <div class="card shadow-sm my-4 mx-4">
                    <div class="card-body mx-4 mt-3">
                        <header class="mb-4">
                            <h2 class="card-title fs-5 mb-2">
                                {{ __('Atur Role') }}
                            </h2>
                            <p class="text-muted small">
                                {{ __("Tambahkan role baru atau kelola role yang tersedia.") }}
                            </p>
                        </header>

                        <!-- Form Tambah Role -->
                        <form action="{{ route('roles-permissions.createRole') }}" method="POST" class="mb-4">
                            @csrf
                            <div class="mb-3">
                                <label for="roleName" class="form-label">Nama Role Baru</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="roleName" name="name" placeholder="Masukkan nama role" required>
                                    <button type="submit" class="btn btn-primary">Tambah Role</button>
                                </div>
                            </div>
                        </form>

                        <hr>

                        <!-- Daftar Role yang Ada -->
                        <h5 class="mt-4 mb-3">Daftar Role</h5>
                        @forelse($roles as $role)
                            <div class="card mb-2">
                                <div class="card-body p-3">
                                    <form action="{{ route('roles-permissions.editRole') }}" method="POST" class="d-flex align-items-center justify-content-between mb-0">
                                        @csrf
                                        <input type="hidden" name="role_id" value="{{ $role->id }}">
                                        <div class="flex-grow-1 me-2">
                                            <input type="text" class="form-control" name="name" value="{{ $role->name }}" required>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i class="fas fa-save"></i>
                                            </button>
                                            @if(!in_array($role->name, ['admin']))
                                            <button type="button" class="btn btn-sm btn-danger delete-role" data-role-id="{{ $role->id }}" data-role-name="{{ $role->name }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info">Belum ada role yang tersedia.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-navigation-layout>