<head>
    @section('PageTitle')
    <title>{{ $title }} - Sispensa</title>
    @endsection
</head>

<x-app-layout>
    <nav x-data="{ open: false }">
        <nav class="sb-topnav navbar navbar-expand navbar-light bg-light shadow">
            <!-- Sidebar Toggle-->
            <button class="btn btn-link order-1 order-lg-0 me-2 ms-lg-3 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Brand-->
            {{-- <a class="navbar-brand ps-3 ps-lg-1 fs-6" href="{{ route('dashboard') }}">Sistem Penilaian Siswa</a> --}}
            <a class="navbar-brand ps-4 ps-lg-2" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/SispensaType.png') }}" alt="Logo Sistem Penilaian Siswa" height="25">
            </a>
            <div class="d-flex align-items-center ms-auto">
                <!-- Navbar -->
                {{-- <ul class="navbar-nav me-2 d-lg-block"> --}}
                <ul class="navbar-nav me-2 d-inline d-lg-none">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user fa-fw"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" style="color: #696f89;" href="{{ route('profile.edit') }}"><i class="fa-solid fa-address-card"></i>&nbsp;&nbsp;Atur Profil</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider d-lg-none">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline d-lg-none">
                                    @csrf
                                    <button type="submit" class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp;Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav me-2 d-none d-lg-block">
                    <a class="nav-link" href="{{ route('profile.edit') }}">
                        <i class="fas fa-user fa-fw"></i>
                    </a>
                </ul>
                <!-- Form Logout -->
                <form method="POST" action="{{ route('logout') }}" class="align-items-center d-none d-lg-block ms-auto my-0 me-3">
                    @csrf
                    <button type="submit" class="btn btn-link d-flex align-items-center" onclick="event.preventDefault(); this.closest('form').submit();">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-right-from-bracket"></i></div>
                        <span class="fw-semibold">&nbsp;&nbsp;Log Out</span>
                    </button>
                </form>
            </div>
        </nav>
        
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-header1">
                        <div class="small">masuk sebagai :</div>
                    </div>
                    <div class="sb-sidenav-header2 {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                        <div class="input-group d-flex justify-content-between">
                            <div class="fw-semibold">{{ Auth::user()->name }}</div>
                            <a class="sb-sidenav-header" href="{{ route('profile.edit') }}"><i class="fa-solid fa-gear"></i></a>
                        </div>
                            <div style="font-size: 0.825em;">{{ Auth::user()->email }}</div>
                    </div>
                    <hr style="margin: 0px"/>

                    <div class="sb-sidenav-menu mt-4 ms-2 me-2 px-1">
                        <div class="nav">
                            <!-- Dashboard -->
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-house"></i></div>
                                &nbsp;Dashboard
                            </a>

                            <!-- Siswa -->
                            @can('melihat siswa')
                            <a class="nav-link {{ request()->routeIs(['students.index', 'students.create', 'students.edit']) ? 'active' : '' }}" href="{{ route('students.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-people-group"></i></div>
                                &nbsp;Siswa
                            </a>
                            @endcan

                            <!-- Nilai -->
                            @can('melihat nilai')
                            <a class="nav-link {{ request()->routeIs(['grades.index', 'grades.create', 'grades.edit']) ? 'active' : '' }}" href="{{ route('grades.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-book-open"></i></div>
                                &nbsp;Nilai
                            </a>    
                            @endcan

                            <!-- Pelajaran -->                           
                            @can('melihat daftar pelajaran')
                            <a class="nav-link {{ request()->routeIs(['subjects.index', 'subjects.create', 'subjects.edit']) ? 'active' : '' }}" href="{{ route('subjects.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-layer-group"></i></div>
                                &nbsp;Pelajaran
                            </a>
                            @endcan

                            {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMasterData" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-table"></i></div>
                                 &nbsp;Master Data
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseMasterData" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav" style="margin-left: 15px; padding-right: 15px; font-size: 0.9em;">

                                    <a class="nav-link gap-1">
                                        <div class="sb-nav-link-icon" style="font-size: 0.5em;"><i class="fa-solid fa-diamond"></i></div>
                                        Data Siswa
                                    </a>

                                    <a class="nav-link gap-1">
                                        <div class="sb-nav-link-icon" style="font-size: 0.5em;"><i class="fa-solid fa-diamond"></i></div>
                                        Data Guru
                                    </a>

                                    <a class="nav-link gap-1">
                                        <div class="sb-nav-link-icon" style="font-size: 0.5em;"><i class="fa-solid fa-diamond"></i></div>
                                        Data Pelajaran
                                    </a>
                                </nav>
                            </div> --}}

                            @canany(['melihat pengguna', 'mengelola roles dan permissions'])
                            <a class="nav-link {{ request()->routeIs(['users.index', 'users.edit', 'users.roles.index', 'users.permissions.index']) ? '' : 'collapsed' }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePengguna" aria-expanded="{{ request()->routeIs(['users.index', 'users.edit', 'roles-permissions.index']) ? 'true' : 'false' }}" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-gear"></i></div>
                                 &nbsp;Pengguna
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse {{ request()->routeIs(['users.index', 'users.edit', 'users.roles.index', 'users.permissions.index']) ? 'show' : '' }}" id="collapsePengguna" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav" style="margin-left: 15px; padding-right: 15px; font-size: 0.9em;">

                                    <!-- Atur Pengguna -->
                                    @can('melihat pengguna')
                                    <a class="nav-link gap-1 {{ request()->routeIs(['users.index', 'users.edit']) ? 'active' : '' }}" href="{{ route('users.index') }}">
                                        <div class="sb-nav-link-icon" style="font-size: 0.5em;"><i class="fa-solid fa-diamond"></i></div>
                                        Akun
                                    </a>
                                    @endcan

                                    <!-- Atur Role -->
                                    @can('mengelola role')
                                    <a class="nav-link gap-1 {{ request()->routeIs('users.roles.index') ? 'active' : '' }}" href="{{ route('users.roles.index') }}">
                                        <div class="sb-nav-link-icon" style="font-size: 0.5em;"><i class="fa-solid fa-diamond"></i></div>
                                        Role
                                    </a>
                                    @endcan

                                    <!-- Atur Permission -->
                                    @can('mengelola permission')
                                    <a class="nav-link gap-1 {{ request()->routeIs('users.permissions.index') ? 'active' : '' }}" href="{{ route('users.permissions.index') }}">
                                        <div class="sb-nav-link-icon" style="font-size: 0.5em;"><i class="fa-solid fa-diamond"></i></div>
                                        Permission
                                    </a>
                                    @endcan
                                </nav>
                            </div>
                            @endcanany
                        </div>
                    </div>
                </nav>
            </div>

            <div id="layoutSidenav_content">
                <!-- Page Heading -->
                @isset($header)
                <div class="bg-light" style="height: 86px">
                    <header class="pt-3 ps-4" style="color: #3d404f">
                            {{ $header }}
                    </header>
                </div>
                <hr style="margin:0px"/>
                @endisset

                <main style="background-color: #e9ecef;">
                    {{ $slot }}
                </main>

                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright 2025 &copy; Sispensa</div>
                            <div>
                                <a href="">Privacy Policy</a>
                                &middot;
                                <a href="">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </nav>
</x-app-layout>