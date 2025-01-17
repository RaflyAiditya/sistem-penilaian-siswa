<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();
        $totalSubjects = Subject::count();
        $totalUsers = User::count();
        $ungradedSubjects = $this->getUngradedSubjects();
        if (auth()->user()->hasRole(['admin', 'guru'])) {
            $totalUngradedSubjects = $ungradedSubjects->count();
        }
        else {
            $totalUngradedSubjects = $ungradedSubjects;
        }

        if (auth()->user()->hasRole('admin')) {
            $recentGrades = Grade::with(['student', 'subject.subjectName', 'subject.teacher'])
            ->where('grade', '>', 0)->orderBy('updated_at', 'desc')->take(5)->get();
        }
        elseif (auth()->user()->hasRole('guru')) {
            $recentGrades = Grade::with(['student', 'subject.subjectName', 'subject.teacher'])
            ->whereHas('subject.teacher', function($query) {
                $query->where('teachers.nip', auth()->user()->nip_or_nis);
            })
            ->where('grade', '>', 0)
            ->orderBy('updated_at', 'desc')
            ->take(3)
            ->get();
        } else {
            $recentGrades = Grade::with(['student', 'subject.subjectName', 'subject.teacher'])
            ->whereHas('student', function($query) {
                $query->where('students.nis', auth()->user()->nip_or_nis);
            })
            ->where('grade', '>', 0)
            ->orderBy('updated_at', 'desc')
            ->take(3)
            ->get();
        }

        return view('dashboard', compact('totalStudents', 'totalSubjects', 'totalUsers', 'totalUngradedSubjects', 'recentGrades'));
    }

    private function getUngradedSubjects()
    {
        if (auth()->user()->hasRole('admin')) {
            return Grade::where('grade', '=', 0)
            ->with(['subject', 'subject.subjectName', 'student'])
            ->get();
        }
        elseif (auth()->user()->hasRole('guru')) {
            $teacherNip = auth()->user()->nip_or_nis;
            return Grade::where('grade', '=', 0)
            ->whereHas('subject', function ($query) use ($teacherNip) {
                $query->join('teachers', 'subjects.teacher_id', '=', 'teachers.id')
                    ->where('teachers.nip', $teacherNip);
            })
            ->get();
        }
    }
}