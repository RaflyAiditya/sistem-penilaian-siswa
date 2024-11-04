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