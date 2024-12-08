<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    // public function index()
    // {
    //     // $subjects = Subject::all();
    //     $subjects = Subject::with('teacher')->get();
    //     $subjectsByDay = [
    //         '1' => Subject::where('day', 'Senin')->get(),
    //         '2' => Subject::where('day', 'Selasa')->get(),
    //         '3' => Subject::where('day', 'Rabu')->get(),
    //         '4' => Subject::where('day', 'Kamis')->get(),
    //         '5' => Subject::where('day', 'Jumat')->get(),
    //     ];
    //     return view('subjects.index', compact('subjectsByDay'));
    // }

    public function index()
    {
        // Peta nama hari berdasarkan angka
        $dayMapping = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
        ];
        $subjects = Subject::with('teacher')->get();
        $subjectsByDayAndClass = collect($dayMapping)->mapWithKeys(function ($dayName, $dayKey) use ($subjects) {
            return [$dayKey => $subjects->where('day', $dayName)->groupBy('class')];
        });

        foreach ($dayMapping as $key => $dayName) {
            if (!isset($subjectsByDayAndClass[$key])) {
                $subjectsByDayAndClass[$key] = collect();
            }
        }
        return view('subjects.index', compact('subjectsByDayAndClass', 'dayMapping'));
    }


    public function create()
    {
        $teachers = Teacher::all();
        return view('subjects.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        // Subject::create($request->validate([
        //     'subject_name' => 'required|string',
        //     'teacher' => 'required|string',
        // ]));
        // return redirect()->route('subjects.index')->with('success', 'Menambahkan data pelajaran berhasil.');

        $validated = $request->validate([
            'subject_name' => 'required|string',
            'class' => 'required|string',
            'teacher_id' => 'required|exists:teachers,id',
            'day' => 'required|string',
            'time_start' => 'required|date_format:H:i',
            'time_end' => 'required|date_format:H:i|after:time_start',
        ]);
        
        $conflict = Subject::where('teacher_id', $validated['teacher_id'])
            ->where('day', $validated['day'])
            ->where(function ($query) use ($validated) {
                $query->whereBetween('time_start', [$validated['time_start'], $validated['time_end']])
                    ->orWhereBetween('time_end', [$validated['time_start'], $validated['time_end']])
                    ->orWhere(function ($query) use ($validated) {
                        $query->where('time_start', '<=', $validated['time_start'])
                            ->where('time_end', '>=', $validated['time_end']);
                    });
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors(['conflict' => 'Jadwal konflik: Guru sudah memiliki pelajaran di hari dan jam yang sama.'])->withInput();
        }

        $classConflict = Subject::where('class', $validated['class'])
            ->where('day', $validated['day'])
            ->where(function ($query) use ($validated) {
                $query->whereBetween('time_start', [$validated['time_start'], $validated['time_end']])
                    ->orWhereBetween('time_end', [$validated['time_start'], $validated['time_end']])
                    ->orWhere(function ($query) use ($validated) {
                        $query->where('time_start', '<=', $validated['time_start'])
                            ->where('time_end', '>=', $validated['time_end']);
                    });
            })
            ->exists();

        if ($classConflict) {
            return back()->withErrors(['conflict' => 'Jadwal konflik: Kelas sudah memiliki pelajaran di hari dan jam yang sama.'])->withInput();
        }

        Subject::create($validated);

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