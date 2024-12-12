<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        // $studentsByClass = [
        //     '7' => Student::where('class', '7')->get(),
        //     '8' => Student::where('class', '8')->get(),
        //     '9' => Student::where('class', '9')->get(),
        // ];
        $studentsByClass = collect([
            '7' => Student::where('class', '7')->get(),
            '8' => Student::where('class', '8')->get(),
            '9' => Student::where('class', '9')->get(),
        ]);
        return view('students.index', compact('studentsByClass'));
    }

    public function create()
    {
        // $classes = ['7', '8', '9'];
        // return view('students.create', compact('classes'));
        return view('students.create');
    }
    public function store(Request $request)
    {
        Student::create($request->validate([
            // 'name' => 'required|string',
            // 'class' => 'required|string',
            // 'email' => 'required|string',
            'name' => 'required|string|max:255',
            'class' => 'required|in:7,8,9',
            'email' => 'required|email|unique:students,email',
        ]));
        return redirect()->route('students.index')->with('success', 'Menambahkan data siswa berhasil.');
    }

    public function edit(Student $student)
    {
        // $classes = ['7', '8', '9'];
        // return view('students.edit', compact(['student', 'classes']));
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $student->update($request->validate([
            // 'name' => 'required|string',
            // 'class' => 'required|string',
            // 'email' => 'required|email',
            'name' => 'required|string|max:255',
            'class' => 'required|in:7,8,9',
            'email' => 'required|email|unique:students,email,' . $student->id,
        ]));
        return redirect()->route('students.index')->with('success', 'Memperbarui data siswa berhasil.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Menghapus data siswa berhasil.');
    }
}