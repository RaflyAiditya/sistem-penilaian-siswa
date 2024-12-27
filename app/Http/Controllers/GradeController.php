<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;

class GradeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:melihat nilai')->only(['index']);
        $this->middleware('permission:input nilai|mengelola data nilai')->only(['edit', 'update']);
        $this->middleware('permission:mengelola data nilai')->only(['store', 'destroy']);
    }

    public function index(Request $request)
    {
        $studentId = $request->input('student_id'); 
        $students = Student::all();
        $classes = Student::select('class')->distinct()->get();

        $gradesQuery = Grade::with(['student', 'subject']);
        if ($studentId) {
            $gradesQuery->where('student_id', $studentId);
        }
        $grades = $gradesQuery->get()->groupBy('student_id');

        return view('grades.index', compact('grades', 'classes', 'students', 'studentId'));
    }

     public function store(Request $request)
    {
        $request->validate([
            'category_type' => 'required|in:class,student',
            'class' => 'required_if:category_type,class',
            'student_id' => 'required_if:category_type,student',
        ]);

        $newGradesAdded = false;

        if ($request->category_type === 'class') {
            // Logika untuk menambah berdasarkan kelas
            $students = Student::where('class', $request->class)->get();
            $subjects = Subject::where('class', $request->class)->get();

            foreach ($students as $student) {
                foreach ($subjects as $subject) {
                    $existingGrade = Grade::where('student_id', $student->id)
                                        ->where('subject_id', $subject->id)
                                        ->first();

                    if (!$existingGrade) {
                        Grade::create([
                            'student_id' => $student->id,
                            'subject_id' => $subject->id,
                            'grade' => $request->input('grade_' . $student->id . '_' . $subject->id, 0),
                        ]);
                        $newGradesAdded = true;
                    }
                }
            }
        } else {
            // Logika untuk menambah berdasarkan siswa individual
            $student = Student::findOrFail($request->student_id);
            $subjects = Subject::where('class', $student->class)->get();

            foreach ($subjects as $subject) {
                $existingGrade = Grade::where('student_id', $student->id)
                                    ->where('subject_id', $subject->id)
                                    ->first();

                if (!$existingGrade) {
                    Grade::create([
                        'student_id' => $student->id,
                        'subject_id' => $subject->id,
                        'grade' => $request->input('grade_' . $student->id . '_' . $subject->id, 0),
                    ]);
                    $newGradesAdded = true;
                }
            }
        }

        if ($newGradesAdded) {
            return redirect()->route('grades.index')->with('success', 'Menambahkan data berhasil.');
        } else {
            return redirect()->route('grades.index')->with('empty', 'Data yang ingin ditambahkan sudah ada.');
        }//Tidak ada data baru yang ditambahkan 
    }

    public function edit(Grade $grade)
    {
        $students = Student::all();
        $subjects = Subject::all();
        return view('grades.edit', compact('grade', 'students', 'subjects'));
    }

    public function update(Request $request, Grade $grade)
    {
        // Cek apakah user yang login adalah guru yang mengajar mata pelajaran tersebut
        if (!auth()->user()->hasRole('admin') && auth()->user()->username !== $grade->subject->teacher->nip) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengubah nilai ini');
        }

        $request->validate([
            'grade' => 'required|numeric|between:0,100',
        ]);

        $grade->update([
            'grade' => $request->input('grade'),
        ]);

        return redirect()->route('grades.index')->with('success', 'Memperbarui nilai berhasil.');
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect()->route('grades.index')->with('success', 'Menghapus nilai berhasil.');
    }

    public function deleteByCategory(Request $request)
    {
        // $request->validate([
        //     'class' => 'required',
        // ]);

        // // Hapus semua data penilaian berdasarkan kelas yang dipilih
        // Grade::whereHas('student', function ($query) use ($request) {
        //     $query->where('class', $request->class);
        // })->delete();

        $request->validate([
            'class' => 'nullable',
            'student_id' => 'nullable',
        ]);
    
        $query = Grade::query();
    
        if ($request->filled('class')) {
            $query->whereHas('student', function ($query) use ($request) {
                $query->where('class', $request->class);
            });
        }
    
        if ($request->filled('student_id')) {
            $query->where('student_id', $request->student_id);
        }
    
        // Hitung jumlah data yang akan dihapus
        $countBeforeDelete = $query->count();
    
        if ($countBeforeDelete > 0) {
            $query->delete();
            return redirect()->route('grades.index')->with('success', 'Data penilaian berhasil dihapus.');
        } else {
            return redirect()->route('grades.index')->with('empty', 'Tidak ada data penilaian yang dihapus.');
        }
    }
}