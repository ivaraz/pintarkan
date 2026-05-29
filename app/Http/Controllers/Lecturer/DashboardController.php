<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Assignment;
use App\Models\Submission;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $lecturer = $user->lecturer;
        $courses = Course::where('lecturer_id', $lecturer->id)->with(['lecturers', 'enrollments'])->get();

        return view('lecturer.dashboard', [
            'courses' => $courses,
            'courseCount' => $courses->count(),
            'studentCount' => Enrollment::whereIn('course_id', $courses->pluck('id'))->distinct('student_id')->count(),
            'assignmentCount' => Assignment::whereIn('course_id', $courses->pluck('id'))->count(),
            'pendingSubmissions' => Submission::whereIn('assignment_id',
                Assignment::whereIn('course_id', $courses->pluck('id'))->pluck('id')
            )->where('status', 'submitted')->count(),
        ]);
    }
}
