<x-navigation-layout title="Profil">

    <x-slot name="header">
        <h1 class="fs-5"><b>Atur Profil</b></h1>

        <x-breadcrumb :items="[
            ['name' => 'Home', 'url' => route('dashboard')],
            ['name' => 'Profil', 'url' => null],
        ]" />
    </x-slot>

    <div class="container py-4">
        {{-- @if(session('success'))
            <script>
                window.sessionSuccessMessage = '{{ session('success') }}';
            </script>
        @endif --}}
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- Profile Information -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Update Password -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Delete Account -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-navigation-layout>
