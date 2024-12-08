<head>
    @section('PageTitle')
    <title>{{ $title }} - Sistem Penilaian Siswa</title>
    @endsection
</head>

{{-- @extends('layouts.app') --}}
<x-app-layout>
{{-- <body>
@section('content') --}}
<nav x-data="{ open: false }">
    <nav class="sb-topnav navbar navbar-expand navbar-light bg-light shadow">
        <!-- Sidebar Toggle-->
        <button class="btn btn-link order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3 ps-lg-2 fs-6" href="{{ route('dashboard') }}">Sistem Penilaian Siswa</a>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto me-3">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">Atur Profile</a>
                    </li>
                    
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-header text-center">
                    <div class="small">masuk sebagai :</div>
                    <div class="">{{ Auth::user()->name }}</div>
                    <div class="small1">{{ Auth::user()->email }}</div> {{-- ms-2 --}}
                </div>
                <hr/>

                <div class="sb-sidenav-menu mt-4 ms-3 me-3">
                    <div class="nav">
                        <!-- Dashboard -->
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-house"></i></div>
                            &nbsp;&nbsp;Dashboard
                        </a>

                        <!-- Siswa -->
                        <a class="nav-link {{ request()->routeIs(['students.index', 'students.create', 'students.edit']) ? 'active' : '' }}" href="{{ route('students.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-people-group"></i></div>
                            &nbsp;&nbsp;Siswa
                        </a>

                        <!-- Nilai -->
                        <a class="nav-link {{ request()->routeIs(['grades.index', 'grades.create', 'grades.edit']) ? 'active' : '' }}" href="{{ route('grades.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-book-open"></i></div>
                            &nbsp;&nbsp;Nilai
                        </a>    

                        <!-- Pelajaran -->

                        {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-layer-group"></i></div>
                            &nbsp;&nbsp;Pelajaran
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link {{ request()->routeIs('subjects.create') ? 'active' : '' }}" href="{{ route('subjects.create') }}">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-layer-group"></i></div>
                                    &nbsp;&nbsp;Pelajaran
                                </a>
                            </nav>
                        </div> --}}
                        
                        <a class="nav-link {{ request()->routeIs(['subjects.index', 'subjects.create', 'subjects.edit']) ? 'active' : '' }}" href="{{ route('subjects.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-layer-group"></i></div>
                            &nbsp;&nbsp;Pelajaran
                        </a>

                        <!-- Atur Pengguna -->
                        @if (auth()->user()->hasRole('admin'))
                            <a class="nav-link {{ request()->routeIs(['users.index', 'users.edit']) ? 'active' : '' }}" href="{{ route('users.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-gear"></i></div>
                                &nbsp;&nbsp;Atur Pengguna
                            </a>
                        @endif
                    </div>
                </div>
            
                {{-- <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    {{ Auth::user()->name }}
                    <div class="small1">{{ Auth::user()->email }}</div>
                </div> --}}
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <!-- Page Heading -->
            @isset($header)
            <div class="bg-white" style="height: 89px">
                <header>
                        {{ $header }}
                </header>
            </div>
            <hr/>
            @endisset

            <div class="">
                <main class="bg-gray-100">
                    {{ $slot }}
                    {{-- {{ dump($slot) }} --}}
                </main>
            </div>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Sistem Penilaian Siswa 2024</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</nav>
{{-- @endsection --}}
</x-app-layout>