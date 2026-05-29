<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of all unique students enrolled in the lecturer's courses.
     */
    public function index()
    {
        $lecturer = auth()->user()->lecturer;

        if (!$lecturer) {
            abort(403, 'Profil Dosen tidak ditemukan.');
        }

        // Get all courses owned by this lecturer
        $courses = Course::where('lecturer_id', $lecturer->id)->get();
        $courseIds = $courses->pluck('id')->toArray();

        // Get all enrollments for these courses, with student & course details
        $enrollments = Enrollment::whereIn('course_id', $courseIds)
            ->with(['student.user', 'course'])
            ->get();

        // Group enrollments by unique student
        $studentsData = [];
        $totalEnrollmentsCount = $enrollments->count();

        foreach ($enrollments as $enrollment) {
            $student = $enrollment->student;
            if (!$student) {
                continue;
            }

            if (!isset($studentsData[$student->id])) {
                $studentsData[$student->id] = [
                    'student' => $student,
                    'courses' => [],
                ];
            }
            $studentsData[$student->id]['courses'][] = $enrollment->course;
        }

        $uniqueStudentsCount = count($studentsData);

        return view('lecturer.students.index', [
            'studentsData' => $studentsData,
            'uniqueStudentsCount' => $uniqueStudentsCount,
            'totalEnrollmentsCount' => $totalEnrollmentsCount,
            'coursesCount' => $courses->count(),
        ]);
    }
}
