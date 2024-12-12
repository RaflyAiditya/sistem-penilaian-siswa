<x-navigation-layout title="Atur Role Permission">

    <x-slot name="header">
        <h1 class="fs-5"><b>Mengatur Role Permission</b></h1>

        <x-breadcrumb :items="[
            ['name' => 'Home', 'url' => route('dashboard')],
            ['name' => 'Atur Role Permission', 'url' => null]
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
                    <!-- Create Role Form -->
                    <form action="{{ route('roles.create') }}" method="POST">
                        @csrf
                        <input type="text" name="name" placeholder="Role Name" required>
                        <button type="submit">Create Role</button>
                    </form>

                    <!-- Assign Permissions Form -->
                    <form action="{{ route('roles.assign-permissions') }}" method="POST">
                        @csrf
                        <select name="role_id" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    
                        <div class="permissions-list">
                            @foreach($permissions as $permission)
                                <label>
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}">
                                    {{ $permission->name }}
                                </label>
                            @endforeach
                        </div>

                        <button type="submit">Assign Permissions</button>
                    </form>                   
                </div>
            </div>
        </div>
    </div>
</x-navigation-layout>