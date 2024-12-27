<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolePermissionController;

Route::get('/', function () {
    return redirect('login');
    // return view('welcome');
})->name('auth.login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');

    Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');
    Route::get('/subjects/create', [SubjectController::class, 'create'])->name('subjects.create');
    Route::post('/subjects', [SubjectController::class, 'store'])->name('subjects.store');
    Route::get('/subjects/{subject}/edit', [SubjectController::class, 'edit'])->name('subjects.edit');
    Route::put('/subjects/{subject}', [SubjectController::class, 'update'])->name('subjects.update');
    Route::delete('/subjects/{subject}', [SubjectController::class, 'destroy'])->name('subjects.destroy');

    Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');
    // Route::get('/grades/create', [GradeController::class, 'create'])->name('grades.create');
    Route::post('/grades', [GradeController::class, 'store'])->name('grades.store');
    Route::get('/grades/{grade}/edit', [GradeController::class, 'edit'])->name('grades.edit');
    Route::put('/grades/{grade}', [GradeController::class, 'update'])->name('grades.update');
    Route::delete('/grades/delete-by-category', [GradeController::class, 'deleteByCategory'])->name('grades.deleteByCategory');
    Route::delete('/grades/{grade}', [GradeController::class, 'destroy'])->name('grades.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::post('/verify-password', [UserController::class, 'verifyPassword']);
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/roles-permissions/roles', [RolePermissionController::class, 'indexRole'])->name('roles-permissions.roles.index');
    Route::get('/roles-permissions/permissions', [RolePermissionController::class, 'indexPermission'])->name('roles-permissions.permissions.index');
    Route::post('/create-role', [RolePermissionController::class, 'createRole'])->name('roles-permissions.createRole');
    Route::post('/roles-permissions/roles/edit', [RolePermissionController::class, 'editRole'])->name('roles-permissions.editRole');
    Route::delete('/roles-permissions/roles/{role}', [RolePermissionController::class, 'deleteRole'])->name('roles-permissions.deleteRole');
    Route::post('/assign-permissions', [RolePermissionController::class, 'assignPermissions'])->name('roles-permissions.assignPermissions');
});

require __DIR__ . '/auth.php';