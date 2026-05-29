<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Material;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function show(Course $course)
    {
        $student = auth()->user()->student;

        // Ensure the student is enrolled in this course
        $enrollment = Enrollment::where('student_id', $student->id)
            ->where('course_id', $course->id)
            ->first();

        if (!$enrollment) {
            abort(403, 'Anda tidak terdaftar di mata kuliah ini.');
        }

        // Load course details with materials and assignments
        $course->load(['lecturers', 'materials', 'assignments' => function($query) {
            $query->orderBy('due_date', 'asc');
        }, 'assignments.submissions' => function($query) use ($student) {
            $query->where('student_id', $student->id)->with('grade');
        }]);

        // Calculate overall progress or average grade for this specific course
        $submissions = $course->assignments->flatMap->submissions;
        $gradedSubmissions = $submissions->where('status', 'graded');
        
        $averageGrade = $gradedSubmissions->count() > 0 
            ? $gradedSubmissions->avg('grade.score') 
            : 0;

        return view('student.courses.show', compact('course', 'enrollment', 'averageGrade'));
    }

    public function showMaterial(Course $course, Material $material)
    {
        $student = auth()->user()->student;

        // Ensure the student is enrolled in this course
        $enrollment = Enrollment::where('student_id', $student->id)
            ->where('course_id', $course->id)
            ->first();

        if (!$enrollment) {
            abort(403, 'Anda tidak terdaftar di mata kuliah ini.');
        }

        // Check if material belongs to course
        if ($material->course_id !== $course->id) {
            abort(404);
        }

        // Record material access
        \Illuminate\Support\Facades\DB::table('material_student')->updateOrInsert(
            ['material_id' => $material->id, 'student_id' => $student->id],
            ['created_at' => now(), 'updated_at' => now()]
        );

        return view('student.materials.show', compact('course', 'material'));
    }
}
