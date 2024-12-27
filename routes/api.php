<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Student;
use App\Models\Subject;

Route::get('/students-subjects', function (Request $request) {
    $class = $request->query('class');
    $students = Student::where('class', $class)->get();
    $subjects = Subject::where('class', $class)->get();

    return response()->json([
        'students' => $students,
        'subjects' => $subjects,
    ]);
});

Route::get('/student-subjects', function (Request $request) {
    $student = Student::findOrFail($request->student_id);
    $subjects = Subject::where('class', $student->class)->get();
    
    return response()->json([
        'subjects' => $subjects
    ]);
});