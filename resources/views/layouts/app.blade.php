<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1 , shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @yield('PageTitle')
        
        {{-- Icon --}}
        <link href="{{ asset('vendor/fontawesome/css/all.min.css') }}" rel="stylesheet">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

        <!-- Scripts CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />

        <!-- Scripts From Tailwind (Maybe) -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    </head>

    <body>
        <div class="sb-nav-fixed" style="background-color: #e9ecef">
            {{ $slot }}
        </div>

        {{-- Scripts JS and Other --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if(Session::has('unauthorized'))
            <meta name="unauthorized-message" content="{{ Session::get('unauthorized') }}">
        @endif
    </body>
</html>