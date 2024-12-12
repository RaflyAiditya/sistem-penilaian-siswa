<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\SubjectName;
use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:melihat nilai')->only(['index']);
        $this->middleware('permission:mengelola nilai')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index()
    {
        $dayMapping = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
        ];
        
        $subjects = Subject::with(['teacher', 'subjectName'])
            ->orderBy('class', 'asc')
            ->orderBy('time_start', 'asc')
            ->get();

        $subjectsByDayAndClass = collect($dayMapping)->mapWithKeys(function ($dayName, $dayKey) use ($subjects) {
            return [
                $dayKey => $subjects->where('day', $dayName)->groupBy('class')->map(function ($classSubjects) {
                    return $classSubjects->sortBy('time_start');
                })
            ];
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
        $subjectNames = SubjectName::all();
        return view('subjects.create', compact('teachers', 'subjectNames'));
    }

    public function store(Request $request)
    {
        $messages = [
            'time_end.after' => 'Waktu selesai harus setelah waktu mulai.',
            'time_start.date_format' => 'Format waktu mulai harus HH:mm.',
            'time_end.date_format' => 'Format waktu selesai harus HH:mm.',
        ];

        $validated = $request->validate([
            'subject_name_id' => 'required|exists:subject_names,subject_name_id',
            'class' => 'required|in:7,8,9',
            'teacher_id' => 'required|exists:teachers,id',
            'day' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
            'time_start' => 'required|date_format:H:i',
            'time_end' => 'required|date_format:H:i|after:time_start',
        ], $messages);
        
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

        return redirect()->route('subjects.index')->with('success', 'Pelajaran berhasil ditambahkan.');
    }

    public function edit(Subject $subject)
    {
        $subjectNames = SubjectName::all();
        $teachers = Teacher::all();
        return view('subjects.edit', compact('subject','subjectNames', 'teachers'));
    }

    public function update(Request $request, Subject $subject)
    {
        $messages = [
            'time_end.after' => 'Waktu selesai harus setelah waktu mulai.',
            'time_start.date_format' => 'Format waktu mulai harus HH:mm.',
            'time_end.date_format' => 'Format waktu selesai harus HH:mm.',
        ];

        $validated = $request->validate([
            'subject_name_id' => 'required|exists:subject_names,subject_name_id',
            'class' => 'required|in:7,8,9',
            'teacher_id' => 'required|exists:teachers,id',
            'day' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
            'time_start' => 'required|date_format:H:i',
            'time_end' => 'required|date_format:H:i|after:time_start',
        ], $messages);

        $conflict = Subject::where('teacher_id', $validated['teacher_id'])
            ->where('day', $validated['day'])
            ->where('id', '!=', $subject->id)
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
            ->where('id', '!=', $subject->id)
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

        $subject->update($validated);
        return redirect()->route('subjects.index')->with('success', 'Data Pelajaran berhasil diperbarui.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Pelajaran berhasil dihapus.');
    }
}