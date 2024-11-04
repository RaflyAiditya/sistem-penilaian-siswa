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
