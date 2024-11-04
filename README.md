
# Mini Project Laravel "Sistem Penilaian Siswa"

Berikut ini dokumentasi pengerjaan pembuatan proyek "Sistem Penilaian Siswa" menggunakan Laravel. Project berisi implementasikan CRUD untuk siswa, mata pelajaran, dan nilai.

![Screenshot (25)](https://github.com/user-attachments/assets/61a83278-7e15-49ee-9478-977f06b94f7f)

![Screenshot (26)](https://github.com/user-attachments/assets/846106d5-93ce-416a-8718-1de283f72b72)

![Screenshot (27)](https://github.com/user-attachments/assets/8642e65c-8199-40e1-8f3e-8a6d4872d75d)

![Screenshot (28)](https://github.com/user-attachments/assets/8bb8705e-312c-4ebe-b886-79cdc7809c89)

![Screenshot (29)](https://github.com/user-attachments/assets/c61bb47c-6d78-4233-a795-f6ebd3590bb3)

![Screenshot (30)](https://github.com/user-attachments/assets/a84505e6-e720-42e4-86d4-4c0b0a435540)

![Screenshot (31)](https://github.com/user-attachments/assets/3a474962-6a39-4525-b763-d0eeef1550fa)

![Screenshot (32)](https://github.com/user-attachments/assets/693b13a8-d4af-4e9f-b483-844595aab161)


### 1. Pembuatan Kerangka Kerja Proyek Dengan Laravel
#### Membuat kerangka kerja Laravel
Menjalankan perintah di terminal dengan menggunakan composer

```bash
  composer create-project laravel/laravel sistem-penilaian-siswa
```

### 2. Pembuatan Database MySql Baru penilaian_siswa

#### Membuka Database MySql dari Terminal

```bash
  mysql -u root -p -P 3306 -h 127.0.0.1
```

#### Membuat Database Baru penilaian_siswa
```bash
CREATE DATABASE penilaian_siswa CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```
#### Edit Environment Development Laravel
Memberitahu Laravel bahwa kita menggunakan database MySql, nama database, username, dan password di MySql

Direktori: sistem-penilaian-siswa/.env

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=penilaian_siswa
DB_USERNAME=root
DB_PASSWORD=
```


### 3. Migrasi Database penilaian_siswa

#### Migrasi Database melalui Terminal
```bash
php artisan migrate
```
Akan muncul 9 tabel baru hasil migrasi database
```bash
+---------------------------+
| Tables_in_penilaian_siswa |
+---------------------------+
| cache                     |
| cache_locks               |
| failed_jobs               |
| job_batches               |
| jobs                      |
| migrations                |
| password_reset_tokens     |
| sessions                  |
| users                     |
+---------------------------+
9 rows in set (0.00 sec)
```


#### Membuat Tabel pada Database penilaian_siswa
Membuat tiga tabel baru "students", "subjects", "grades" pada database dengan menggunakan Migration

```bash
php artisan make:migration create_students_table
php artisan make:migration create_subjects_table
php artisan make:migration create_grades_table
```

#### Memodifikasi isi Migration Tabel
Sebelum migrate dieksekusi, perlu memodifikasi isi migrations agar sesuai dengan yang diinginkan

Direktori: sistem-penilaian-siswa/database/migrations/[file migrations students]
```php
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('class');
            $table->string('email');
            $table->timestamps();
        });
    }
```

Direktori: sistem-penilaian-siswa/database/migrations/[file migrations subjects]
```php
    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('subject_name');
            $table->string('teacher');
            $table->timestamps();
        });
    }
```

Direktori: sistem-penilaian-siswa/database/migrations/[file migrations grades]
```php
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('subject_id');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->string('grade');
            $table->timestamps();
        });
    }
```

#### Eksekusi Migration
Untuk membuat tabel dan strukturnya sesuai isi migrations

```bash
php artisan migrate
```

### 4. Membuat Model
#### Eksekusi pembuatan Model
Mengeksekusi perintah berikut di terminal untuk membuat model "Students.php", "Subjects.php", dan "Grades.php". Digunakan untuk berinteraksi dengan tabel yang ada di database.

```bash
php artisan make:model Students
php artisan make:model Subjects
php artisan make:model Grades
```

#### Mengatur Mass Assignment pada Model

Direktori: sistem-penilaian-siswa/app/Models/Students.php

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $fillable = [
        'name',
        'class',
        'email',
    ];

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
```

Direktori: sistem-penilaian-siswa/app/Models/Subjects.php

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects';
    protected $fillable = [
        'subject_name',
        'teacher',
    ];

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
```

Direktori: sistem-penilaian-siswa/app/Models/Grades.php

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grades';
    protected $fillable = [
        'student_id',
        'subject_id',
        'grade',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
```

### 5. Membuat Controller
#### Eksekusi pembuatan Controller
Mengeksekusi perintah berikut di terminal untuk membuat controller "StudentsController.php", "SubjetsController.php", dan "GradesController.php".

```bash
php artisan make:controller StudentsController
php artisan make:controller SubjetsController
php artisan make:controller GradesController
```


#### Mengatur Controller

Direktori: sistem-penilaian-siswa/app/Http/Controllers/StudentsController.php

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        Student::create($request->validate([
            'name' => 'required|string',
            'class' => 'required|string',
            'email' => 'required|string',
        ]));
        return redirect()->route('students.index')->with('success', 'Menambahkan data siswa berhasil.');
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $student->update($request->validate([
            'name' => 'required|string',
            'class' => 'required|string',
            'email' => 'required|email',
        ]));
        return redirect()->route('students.index')->with('success', 'Memperbarui data siswa berhasil.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Menghapus data siswa berhasil.');
    }
}
```

Direktori: sistem-penilaian-siswa/app/Http/Controllers/SubjectsController.php

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(Request $request)
    {
        Subject::create($request->validate([
            'subject_name' => 'required|string',
            'teacher' => 'required|string',
        ]));
        return redirect()->route('subjects.index')->with('success', 'Menambahkan data pelajaran berhasil.');
    }

    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $subject->update($request->validate([
            'subject_name' => 'required|string',
            'teacher' => 'required|string',
        ]));
        return redirect()->route('subjects.index')->with('success', 'Memperbarui data pelajaran berhasil.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Menghapus data pelajaran berhasil.');
    }
}
```

Direktori: sistem-penilaian-siswa/app/Http/Controllers/GradesController.php

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with(['student', 'subject'])->get();
        return view('grades.index', compact('grades'));
    }

    public function create()
    {
        $students = Student::all();
        $subjects = Subject::all();
        return view('grades.create', compact('students', 'subjects'));
    }

    public function store(Request $request)
    {
        Grade::create($request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'grade' => 'required|integer|min:0|max:100',
        ]));
        return redirect()->route('grades.index')->with('success', 'Menambahkan nilai berhasil.');
    }

    public function edit(Grade $grade)
    {
        $students = Student::all();
        $subjects = Subject::all();
        return view('grades.edit', compact('grade', 'students', 'subjects'));
    }

    public function update(Request $request, Grade $grade)
    {
        $grade->update($request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'grade' => 'required|integer|min:0|max:100',
        ]));
        return redirect()->route('grades.index')->with('success', 'Memperbarui nilai berhasil.');
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect()->route('grades.index')->with('success', 'Menghapus nilai berhasil.');
    }
}
```

### 6. Mengatur Routing

Membuka dan mengatur isi file sistem-penilaian-siswa/routes/web.php

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\GradeController;

// Route untuk Root
Route::get('/', [GradeController::class, 'index'])->name('layout');

// Route untuk Student
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');

// Route untuk Subject
Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');
Route::get('/subjects/create', [SubjectController::class, 'create'])->name('subjects.create');
Route::post('/subjects', [SubjectController::class, 'store'])->name('subjects.store');
Route::get('/subjects/{subject}/edit', [SubjectController::class, 'edit'])->name('subjects.edit');
Route::put('/subjects/{subject}', [SubjectController::class, 'update'])->name('subjects.update');
Route::delete('/subjects/{subject}', [SubjectController::class, 'destroy'])->name('subjects.destroy');

// Route untuk Grade
Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');
Route::get('/grades/create', [GradeController::class, 'create'])->name('grades.create');
Route::post('/grades', [GradeController::class, 'store'])->name('grades.store');
Route::get('/grades/{grade}/edit', [GradeController::class, 'edit'])->name('grades.edit');
Route::put('/grades/{grade}', [GradeController::class, 'update'])->name('grades.update');
Route::delete('/grades/{grade}', [GradeController::class, 'destroy'])->name('grades.destroy');
```

### 6. Membuat View/Tampilan Web Untuk CRUD

#### Membuat Folder dan File Blade untuk View/Tampilan Web
Membuat folder baru "students", "subjects", dan "grades" di dalam direktori sistem-penilaian-siswa/resources/view
```bash
  mkdir resources/views/students
  mkdir resources/views/subjects
  mkdir resources/views/grades
```

Membuat file baru "index.blade.php", "create.blade.php", dan "edit.blade.php" di dalam masing-masing folder yang baru dibuat dan file "layout.blade.php" di dalam direktori paling luar folder view
```bash 
  touch resources/views/students/index.blade.php
  touch resources/views/students/create.blade.php
  touch resources/views/students/edit.blade.php

  touch resources/views/subjects/index.blade.php
  touch resources/views/subjects/create.blade.php
  touch resources/views/subjects/edit.blade.php

  touch resources/views/grades/index.blade.php
  touch resources/views/grades/create.blade.php
  touch resources/views/grades/edit.blade.php

  touch resources/views/layout.blade.php
```

#### Membuat View/Tampilan Web dengan Blade

Direktori: sistem-penilaian-siswa/resources/views/layout.blade.php
```php
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
```


Direktori: sistem-penilaian-siswa/resources/views/students/index.blade.php
```php
@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Daftar Siswa</h2>
    <a href="{{ route('students.create') }}" class="btn btn-primary">Tambah Siswa</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->class }}</td>
                <td>{{ $student->email }}</td>
                <td>
                    <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
```


Direktori: sistem-penilaian-siswa/resources/views/students/create.blade.php
```php
@extends('layout')

@section('content')
<h1>Tambah Siswa</h1>

<form action="{{ route('students.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="class" class="form-label">Kelas</label>
        <input type="text" name="class" id="class" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Tambah Siswa</button>
    <a href="{{ route('students.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
```


Direktori: sistem-penilaian-siswa/resources/views/students/edit.blade.php
```php
@extends('layout')

@section('content')
<h1>Edit Siswa</h1>

<form action="{{ route('students.update', $student) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $student->name) }}"
            required>
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="class" class="form-label">Kelas</label>
        <input type="text" name="class" id="class" class="form-control" value="{{ old('class', $student->class) }}"
            required>
        @error('class')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $student->email) }}"
            required>
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <a href="{{ route('students.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
```

Direktori: sistem-penilaian-siswa/resources/views/subjects/index.blade.php
```php
@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Daftar Pelajaran</h2>
    <a href="{{ route('subjects.create') }}" class="btn btn-primary">Tambah Pelajaran</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Pelajaran</th>
            <th>Guru</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($subjects as $subject)
            <tr>
                <td>{{ $subject->subject_name}}</td>
                <td>{{ $subject->teacher}}</td>
                <td>
                    <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('subjects.destroy', $subject) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
```


Direktori: sistem-penilaian-siswa/resources/views/subjects/create.blade.php
```php
@extends('layout')

@section('content')
<h1>Tambah Pelajaran</h1>

<form action="{{ route('subjects.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="subject_name" class="form-label">Nama Pelajaran</label>
        <input type="text" name="subject_name" id="subject_name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="teacher" class="form-label">Guru</label>
        <input type="text" name="teacher" id="teacher" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Tambah Pelajaran</button>
    <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
```


Direktori: sistem-penilaian-siswa/resources/views/subjects/edit.blade.php
```php
@extends('layout')

@section('content')
<h1>Edit Siswa</h1>

<form action="{{ route('subjects.update', $subject) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="subject_name" class="form-label">Nama Pelajaran</label>
        <input type="text" name="subject_name" id="subject_name" class="form-control"
            value="{{ old('subject_name', $subject->subject_name) }}" required>
        @error('subject_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="teacher" class="form-label">Kelas</label>
        <input type="text" name="teacher" id="teacher" class="form-control"
            value="{{ old('teacher', $subject->teacher) }}" required>
        @error('teacher')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
```

Direktori: sistem-penilaian-siswa/resources/views/grades/index.blade.php
```php
@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Daftar Nilai</h2>
    <a href="{{ route('grades.create') }}" class="btn btn-primary">Tambah Nilai</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Mata Pelajaran</th>
            <th>Guru</th>
            <th>Nilai</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($grades as $grade)
            <tr>
                <td>{{ $grade->student->name }}</td>
                <td>{{ $grade->student->class }}</td>
                <td>{{ $grade->subject->subject_name }}</td>
                <td>{{ $grade->subject->teacher }}</td>
                <td>{{ $grade->grade }}</td>
                <td>
                    <a href="{{ route('grades.edit', $grade) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('grades.destroy', $grade) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
```


Direktori: sistem-penilaian-siswa/resources/views/grades/create.blade.php
```php
@extends('layout')

@section('content')
<h1>Tambah Nilai</h1>

<form action="{{ route('grades.store') }}" method="POST">
    @csrf

    <!-- Dropdown untuk memilih siswa -->
    <div class="mb-3">
        <label for="student_id" class="form-label">Siswa</label>
        <select name="student_id" id="student_id" class="form-control" required>
            <option value="">Pilih Siswa</option>
            @foreach($students as $student)
                <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                    {{ $student->name }}
                </option>
            @endforeach
        </select>
        @error('student_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Dropdown untuk memilih mata pelajaran -->
    <div class="mb-3">
        <label for="subject_id" class="form-label">Mata Pelajaran</label>
        <select name="subject_id" id="subject_id" class="form-control" required>
            <option value="">Pilih Mata Pelajaran</option>
            @foreach($subjects as $subject)
                <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                    {{ $subject->subject_name }}
                </option>
            @endforeach
        </select>
        @error('subject_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Input nilai -->
    <div class="mb-3">
        <label for="grade" class="form-label">Nilai</label>
        <input type="number" name="grade" id="grade" class="form-control" min="0" max="100" value="{{ old('grade') }}"
            required>
        @error('grade')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success">Tambah Nilai</button>
    <a href="{{ route('grades.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
```


Direktori: sistem-penilaian-siswa/resources/views/grades/edit.blade.php
```php
@extends('layout')

@section('content')
<h1>Edit Nilai</h1>

<form action="{{ route('grades.update', $grade) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Dropdown untuk memilih siswa -->
    <div class="mb-3">
        <label for="student_id" class="form-label">Siswa</label>
        <select name="student_id" id="student_id" class="form-control" required>
            <option value="">Pilih Siswa</option>
            @foreach($students as $student)
                <option value="{{ $student->id }}" {{ $student->id == $grade->student_id ? 'selected' : '' }}>
                    {{ $student->name }}
                </option>
            @endforeach
        </select>
        @error('student_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Dropdown untuk memilih mata pelajaran -->
    <div class="mb-3">
        <label for="subject_id" class="form-label">Mata Pelajaran</label>
        <select name="subject_id" id="subject_id" class="form-control" required>
            <option value="">Pilih Mata Pelajaran</option>
            @foreach($subjects as $subject)
                <option value="{{ $subject->id }}" {{ $subject->id == $grade->subject_id ? 'selected' : '' }}>
                    {{ $subject->subject_name }}
                </option>
            @endforeach
        </select>
        @error('subject_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Input nilai -->
    <div class="mb-3">
        <label for="grade" class="form-label">Nilai</label>
        <input type="number" name="grade" id="grade" class="form-control" min="0" max="100"
            value="{{ old('grade', $grade->grade) }}" required>
        @error('grade')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <a href="{{ route('grades.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
```

## 

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
