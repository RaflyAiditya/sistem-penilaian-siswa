<x-navigation-layout title="Permission">

    <x-slot name="header">
        <h1 class="fs-5"><b>Kelola Permission</b></h1>

        <x-breadcrumb :items="[
            ['name' => 'Home', 'url' => route('dashboard')],
            ['name' => 'Pengguna', 'url' => null],
            ['name' => 'Permission', 'url' => null]
        ]" />
    </x-slot>

    <div class="container-fluid px-4">
        @if(session('success'))
            <script>
                window.sessionSuccessMessage = '{{ session('success') }}';
            </script>
        @endif
        <div class="row justify-content-center">

            <!-- Assign Permissions Form -->
            <div class="col-md-8">
                <div class="card shadow-sm my-4 mx-4">
                    <div class="card-body mx-4 mt-3">
                        <header class="mb-4">
                            <h2 class="card-title fs-5 mb-2">
                                {{ __('Kelola Permission') }}
                            </h2>
                            <p class="text-muted small">
                                {{ __("Kelola permission untuk role yang telah ada") }}
                            </p>
                        </header>
                        <form action="{{ route('users.assignPermissions') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="roleSelect" class="form-label">Pilih Role</label>
                                <select class="form-select" id="roleSelect" style="max-width: 200px;" name="role_id" required>
                                    <option value="" selected disabled>Pilih Role...</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Daftar Permission</label>
                                <div class="row g-3">
                                    @foreach($permissions as $permission)
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input permission-checkbox" 
                                                    type="checkbox" 
                                                    name="permissions[]" 
                                                    value="{{ $permission->name }}"
                                                    id="perm{{ $loop->index }}">
                                                <label class="form-check-label" for="perm{{ $loop->index }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success" style="font-size: 0.9rem;"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            window.rolePermissions = {!! json_encode($rolePermissions) !!};
        </script>
    </div>
</x-navigation-layout>