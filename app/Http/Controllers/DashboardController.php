<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Assignment;
use App\Models\Submission;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\Enrollment;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $courses = Course::paginate(5);

        // Admin Dashboard Data
        if ($user->hasRole('admin')) {
            return view('admin.dashboard', [
                'totalUsers' => User::count(),
                'totalLecturers' => Lecturer::count(),
                'totalStudents' => Student::count(),
                'totalCourses' => Course::count(),
                'totalAssignments' => Assignment::count(),
                'recentEnrollments' => Enrollment::latest()->take(5)->with('student', 'course')->get(),
                'courses' => $courses,
            ]);
        }

        // Lecturer Dashboard Data
        if ($user->hasRole('lecturer')) {
            $lecturer = $user->lecturer;
            $courses = Course::where('lecturer_id', $lecturer->id)->with(['lecturers', 'enrollments'])->get();

            return view('dosen.dashboard', [
                'courses' => $courses,
                'courseCount' => $courses->count(),
                'studentCount' => Enrollment::whereIn('course_id', $courses->pluck('id'))->distinct('student_id')->count(),
                'assignmentCount' => Assignment::whereIn('course_id', $courses->pluck('id'))->count(),
                'pendingSubmissions' => Submission::whereIn('assignment_id',
                    Assignment::whereIn('course_id', $courses->pluck('id'))->pluck('id')
                )->where('status', 'submitted')->count(),
            ]);
        }

        // Student Dashboard Data
        if ($user->hasRole('student')) {
            $student = $user->student;
            $enrollments = Enrollment::where('student_id', $student->id)->with('course')->get();
            $courseIds = $enrollments->pluck('course_id');

            $assignments = Assignment::whereIn('course_id', $courseIds)->get();
            $submissions = Submission::where('student_id', $student->id)->get();

            return view('mahasiswa.dashboard', [
                'enrollments' => $enrollments,
                'enrollmentCount' => $enrollments->count(),
                'assignmentCount' => $assignments->count(),
                'completedAssignments' => $submissions->where('status', 'graded')->count(),
                'averageGrade' => $submissions->where('status', 'graded')->avg('grade') ?? 0,
                'assignments' => $assignments->sortBy('due_date'),
            ]);
        }

        return view('dashboard.index');
    }
}


