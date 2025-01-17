<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Grade;
use App\Models\Subject;

class GradeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:melihat nilai')->only(['index']);
        $this->middleware('permission:memberikan nilai|mengelola data nilai')->only(['edit', 'update']);
        $this->middleware('permission:mengelola data nilai')->only(['store', 'destroy']);
    }

    public function index(Request $request)
    {
        $class = $request->input('class');
        $studentId = $request->input('student_id');
        $subjectId = $request->input('subject_id');
        $teacherId = $request->input('teacher_id');
        $search = $request->input('search');

        $classes = Student::select('class')->distinct()->orderBy('class', 'asc')->get();
        // $students = Student::all();
        // $subjects = Subject::select('subject_name_id')->distinct()->orderBy('subject_name_id', 'asc')->get();
        $teachers = Teacher::orderBy('name', 'asc')->get();

        $gradesQuery = Grade::with(['student', 'subject', 'subject.teacher']);

        // Handle roles pengguna yang berbeda
        if (auth()->user()->hasRole('admin')) {
            // Admin melihat semua nilai dan siswa
            $studentsQuery = Student::orderBy('name', 'asc');
           
            if ($class) {
                // Filter siswa berdasarkan kelas yang dipilih
                $studentsQuery->where('class', $class);
            }

            $students = $studentsQuery->get();

            if ($class) {
                $gradesQuery->whereHas('student', function ($query) use ($class) {
                    $query->where('class', $class);
                });
            }

            if ($studentId) {
                $gradesQuery->where('student_id', $studentId);
            }
    
            if ($teacherId) {
                $gradesQuery->whereHas('subject.teacher', function ($query) use ($teacherId) {
                    $query->where('id', $teacherId);
                });
            }
            
        } elseif (auth()->user()->hasRole('guru')) {
            // Guru hanya melihat nilai siswa yang diajar
            $teacherNip = auth()->user()->nip_or_nis;
            $gradesQuery->whereHas('subject', function($query) use ($teacherNip) {
                $query->whereHas('teacher', function($q) use ($teacherNip) {
                    $q->where('nip', $teacherNip);
                });
            });

            // Get siswa berdasarkan kelas yang diajar oleh guru ini
            $studentsQuery = Student::whereIn('class', function($query) use ($teacherNip) {
                $query->select('class')
                    ->from('subjects')
                    ->join('teachers', 'subjects.teacher_id', '=', 'teachers.id')
                    ->where('teachers.nip', $teacherNip);
            });
        
            // Tambahkan filter kelas
            if ($class) {
                $studentsQuery->where('class', $class);
            }

            $students = $studentsQuery->orderBy('name', 'asc')->get();
    
            // Tambahkan filter nilai berdasarkan siswa dan kelas
            if ($class) {
                $gradesQuery->whereHas('student', function ($query) use ($class) {
                    $query->where('class', $class);
                });
            }
            if ($studentId) {
                $gradesQuery->where('student_id', $studentId);
            }
        } else {
            // Siswa hanya melihat nilai mereka sendiri
            $studentNis = auth()->user()->nip_or_nis;
            $gradesQuery->whereHas('student', function($query) use ($studentNis) {
                $query->where('nis', $studentNis);
            });
            
            // Untuk siswa, tidak memerlukan dropdown sehingga collection dapat diatur kosong
            $students = collect();
        }

        $grades = $gradesQuery->get()->groupBy('student_id');

        return view('grades.index', compact('grades', 'classes', 'students', 'teachers','studentId', 'class', 'subjectId', 'teacherId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_type' => 'required|in:class,student',
            'class' => 'required_if:category_type,class',
            'student_id' => 'required_if:category_type,student',
            'subject_id' => 'required_if:category_type,subject',
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
        } elseif ($request->category_type === 'student') {
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
        } else {
            // Logika untuk menambah berdasarkan mata pelajaran
            $subject = Subject::findOrFail($request->id);
            $students = Student::where('class', $subject->class)->get();

            foreach ($students as $student) {
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
        }
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
        if (!auth()->user()->hasRole('admin') && auth()->user()->nip_or_nis !== $grade->subject->teacher->nip) {
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

    public function deleteByCategory(Request $request)
    {
        $request->validate([
            'class' => 'nullable',
            'student_id' => 'nullable',
            'subject_id' => 'nullable',
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
    
        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
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