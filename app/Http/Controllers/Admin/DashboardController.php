<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Assignment;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $courses = Course::paginate(5);

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
}
