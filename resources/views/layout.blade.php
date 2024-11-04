<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <br>
    <h1 class="text-center">SISTEM PENILAIAN SISWA</h1>
    <div class="center container mt-4">
        <div class="d-flex justify-content-center align-items-center">
            <a href="{{ route('grades.index') }}" class="btn btn-outline-secondary mx-2">Nilai</a>
            <a href="{{ route('students.index') }}" class="btn btn-outline-secondary mx-2">Siswa</a>
            <a href="{{ route('subjects.index') }}" class="btn btn-outline-secondary mx-2">Pelajaran</a>
        </div>
        <br>
        @yield('content')
    </div>
</body>

</html>