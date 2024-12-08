<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 , shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Sistem Penilaian Siswa') }}</title> --}}
    {{-- <title>@yield('PageTitle') - Sistem Penilaian Siswa</title> --}}
    @yield('PageTitle')
    {{-- <title>{{ $title }} - Sistem Penilaian Siswa</title> --}}

    {{-- <title>{{ $PageTitle }}</title> --}}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />

    <link href="{{ asset('vendor/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts From Tailwind (Maybe) -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body>
    <div class="sb-nav-fixed bg-gray-100">
    {{-- <div class="min-h-screen bg-gray-100"> --}}
        {{-- @include('layouts.navigation') --}}

        <!-- Page Heading -->
        {{-- @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset --}}

        <!-- Page Content -->
        {{-- <main> --}}
        {{ $slot }}
        {{-- @yield('content') --}}
        {{-- </main> --}}
    </div>

    {{-- Scripts JS and Other --}}
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
</body>

</html>