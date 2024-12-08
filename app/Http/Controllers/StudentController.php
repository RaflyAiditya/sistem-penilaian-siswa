<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        // $students = Student::all();
        $studentsByClass = [
            '7' => Student::where('class', '7')->get(),
            '8' => Student::where('class', '8')->get(),
            '9' => Student::where('class', '9')->get(),
        ];
        return view(
            'students.index',
            compact('studentsByClass')
        );
    }

    public function create()
    {
        $classes = ['7', '8', '9'];
        return view(
            'students.create',
            compact('classes')
        );
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
        $classes = ['7', '8', '9'];
        return view('students.edit', compact(['student', 'classes']));
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